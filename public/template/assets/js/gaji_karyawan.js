$(document).ready(function () {
    // Tangkap perubahan pada elemen <select>
    $('#selectKaryawan').change(function () {
        // Dapatkan ID Karyawan yang dipilih
        var selectedId = $(this).val();

        // Cari Karyawan yang sesuai dengan ID yang dipilih dari $dataKaryawan
        var selectedKaryawan = $.grep(dataKaryawan, function (karyawan) {
            return karyawan.id == selectedId;
        });
        console.log(selectedKaryawan);
        // Perbarui nilai elemen HTML dengan data Karyawan yang sesuai
        $('#namaKaryawan').val(': ' + selectedKaryawan[0].name);
        $('#emailKaryawan').val(': ' + selectedKaryawan[0].email);
        $('#teleponKaryawan').val(': ' + (selectedKaryawan[0].nomor_telepon ? selectedKaryawan[0].nomor_telepon : '-'));
        $('#alamatKaryawan').val(': ' + (selectedKaryawan[0].alamat ? selectedKaryawan[0].alamat : '-'));
        $('#jabatanKaryawan').val(': ' + selectedKaryawan[0].jabatan.jabatan);

        function formatMoney(amount) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
            });

            return formatter.format(amount);
        }
        $('#gajiKaryawan').val(': ' + formatMoney(selectedKaryawan[0].jabatan.gaji));


        // Hitung jumlah Hadir, Izin, Sakit, dan Alpha
        var jumlahHadir = 0;
        var jumlahIzin = 0;
        var jumlahSakit = 0;
        var jumlahAlpha = 0;

        selectedKaryawan[0].absents.forEach(function (absent) {
            if (absent.status === 'Hadir') {
                jumlahHadir++;
            } else if (absent.status === 'Izin') {
                jumlahIzin++;
            } else if (absent.status === 'Sakit') {
                jumlahSakit++;
            } else if (absent.status === 'Alpha') {
                jumlahAlpha++;
            }
        });

        // Perbarui nilai elemen HTML dengan jumlah Hadir, Izin, Sakit, dan Alpha
        $('#jumlahHadir').val(': ' + jumlahHadir);
        $('#jumlahIzin').val(': ' + jumlahIzin);
        $('#jumlahSakit').val(': ' + jumlahSakit);
        $('#jumlahAlpha').val(': ' + jumlahAlpha);

        // Isi nilai namaKaryawanInput ke dalam input hidden
        $('#namaKaryawanInput').val(selectedKaryawan[0].name);
        $('#emailkaryawanInput').val(selectedKaryawan[0].email);

        // Isi nilai gajiKaryawanInput ke dalam input hidden
        $('#gajiKaryawanInput').val(selectedKaryawan[0].jabatan.gaji);

        // Isi nilai jumlahHadirInput ke dalam input hidden
        $('#jumlahHadirInput').val(jumlahHadir);

        // Isi nilai jumlahIzinInput ke dalam input hidden
        $('#jumlahIzinInput').val(jumlahIzin);

        // Isi nilai jumlahSakitInput ke dalam input hidden
        $('#jumlahSakitInput').val(jumlahSakit);

        // Isi nilai jumlahAlphaInput ke dalam input hidden
        $('#jumlahAlphaInput').val(jumlahAlpha);

        // Isi nilai idUserInput ke dalam input hidden
        $('#idUserInput').val(selectedKaryawan[0].id);
    });
});
