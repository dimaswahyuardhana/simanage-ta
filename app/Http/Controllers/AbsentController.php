<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $company = company::select('longitude', 'latitude', 'id_company')
            ->where('id_company', $user->id_company)
            ->get();

        return view('landingpage.section.absensi', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function absent(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah absent hari ini
        $absent = Absent::where('id_user', $user->id)
            ->where('time_in', '!=', NULL)
            ->whereRaw('date(created_at) = CURRENT_DATE()')
            ->first();

        $x = $request->validate([
            'status' => 'required'
        ], [
            'status.required' => 'Status harus dipilih'
        ]);

        if ($request->input('status') == 'Hadir') {
            if (intval($request->input('distance')) < 1000) {
                if ($absent) {
                    // Jika sudah absent, kirimkan respons dengan pesan error
                    // return response()->json(['error' => 'Anda sudah Absent hari ini']);
                    return redirect('/absent')->with('error', 'Anda sudah Absent hari ini');
                } else {
                    $validated = $request->validate([
                        'status' => 'required',
                        'lampiran' => 'mimes:pdf',
                    ], [
                        'status.required' => 'Status harus dipilih',
                        'lampiran.mimes' => 'Lampiran Surat harus dalam format PDF'
                    ]);

                    $validated['time_in'] = Carbon::now();

                    $waktu = $validated['time_in']->format('d-m-y');
                    $file = $request->file('lampiran');
                    // $extension = $file->getClientOriginalExtension();
                    $filename = 'lampiran_' . $user->name . '_' . $waktu . '.' . 'pdf';

                    if ($file != null) {
                        $validated['lampiran'] = $file->storeAs('lampiran', $filename);
                    } else {
                        $validated['lampiran'] = null;
                    }

                    Absent::where('id_user', $user->id)
                        ->whereRaw('date(created_at) = CURRENT_DATE()')
                        ->update([
                            'time_in' => $validated['time_in'],
                            'status' => $validated['status'],
                            'keterangan' => request()->input('keterangan'),
                            'lampiran' => $validated['lampiran']
                        ]);

                    return redirect('/absent')->with('success', 'Absent berhasil');
                }
            } else {
                return redirect()->back()->with('error', 'Jarak Anda terlalu jauh');
            }
        } else {
            if ($absent) {
                // Jika sudah absent, kirimkan respons dengan pesan error
                // return response()->json(['error' => 'Anda sudah Absent hari ini']);
                return redirect('/absent')->with('error', 'Anda sudah Absent hari ini');
            } else {
                $validated = $request->validate([
                    'status' => 'required',
                    'lampiran' => 'required|mimes:pdf',
                ], [
                    'status.required' => 'Status harus dipilih',
                    'lampiran.required' => 'Lampiran Surat harus diisi',
                    'lampiran.mimes' => 'Lampiran Surat harus dalam format PDF'
                ]);

                $validated['time_in'] = Carbon::now();

                $waktu = $validated['time_in']->format('d-m-y');
                $file = $request->file('lampiran');
                // $extension = $file->getClientOriginalExtension();
                $filename = 'lampiran_' . $user->name . '_' . $waktu . '.' . 'pdf';

                if ($file != null) {
                    $validated['lampiran'] = $file->storeAs('lampiran', $filename);
                } else {
                    $validated['lampiran'] = null;
                }

                Absent::where('id_user', $user->id)
                    ->whereRaw('date(created_at) = CURRENT_DATE()')
                    ->update([
                        'time_in' => $validated['time_in'],
                        'status' => $validated['status'],
                        'keterangan' => request()->input('keterangan'),
                        'lampiran' => $validated['lampiran']
                    ]);

                return redirect('/absent')->with('success', 'Absent berhasil');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //
    }
}
