<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slip Gaji {{ $dataGaji->nama_karyawan }}</title>
    <style>
        * {
            margin-left: auto;
            margin-right: auto;
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
            align-items: center;
        }

        table tr td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div align="center">
        <table>
            <tr>
                <td colspan="3" align="center">
                    <h3>Slip Gaji Karyawan {{ $dataGaji->nama_karyawan }}</h3>
                </td>
            </tr>
            <tr>
                <td width="200">Nama Karyawan</td>
                <td>:</td>
                <td>
                    {{ $dataGaji->nama_karyawan }}
                </td>
            </tr>
        </table>
        <table border="1" class="table_detail">
            <tr>
                <td align="center">No</td>
                <td width="160" align="center">Keterangan</td>
                <td width="150" align="center">Nominal</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Gaji Pokok</td>
                <td align="right">Rp. {{ number_format($dataGaji->total_gaji, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
