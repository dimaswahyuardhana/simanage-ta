<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\company;
use App\Models\Jabatan;
use Faker\Provider\ar_EG\Company as Ar_EGCompany;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function indexRegisAdmin()
    {
        return view('admin.auth.register');
    }

    public function indexRegisEmployee()
    {
        return view('employee.auth.register');
    }

    public function registrasiAdmin(Request $request)
    {
        $id_role = 1;
        $company_name = $request->input('company_name');
        $idCompany = strtolower(str_replace(' ', '', $company_name)) . '-' . Str::random(10);
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required'],
            'company_name' => ['required', 'string', 'max:100', 'unique:companies,company_name']
        ]);

        // if($request->validate()) {
        $company = company::create([
            'id_company' => $idCompany,
            'company_name' => $request->input('company_name')
        ]);
        $jabatan = Jabatan::create([
            'id_company' => $idCompany
        ]);

        $none = Jabatan::select('id_company', 'jabatan', 'id_jabatan')
            ->where('id_company', $idCompany)
            ->where('jabatan', 'none')
            ->get();

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'id_company' => $idCompany,
            'id_role' => $id_role,
            'password' => Hash::make($request['password']),
            'id_jabatan' => 1,
        ]);
        // }

        return redirect('/login');
    }

    public function registrasiEmployee(Request $request)
    {
        $id_role = 2;
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required'],
            'id_company' => ['required', 'string', 'max:100', 'exists:companies,id_company']
        ]);

        $none = Jabatan::select('id_company', 'jabatan', 'id_jabatan')
            ->where('id_company', $validated['id_company'])
            ->where('jabatan', 'none')
            ->get();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'id_company' => $validated['id_company'],
            'id_role' => $id_role,
            'password' => Hash::make($validated['password']),
            'id_jabatan' => $none[0]->id_jabatan,
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        //dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:100', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->id_role == 1) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
            if (Auth::user()->id_role == 2) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }
        return back()->withErrors([
            'email' => 'Email and Password invalid'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
