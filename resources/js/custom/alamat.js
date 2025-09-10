// jQuery untuk get alamat 
$(document).ready(function() {
    // Load provinsi saat halaman dibuka
    $.get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(data) {
        $('#provinsi').append('<option value="">-- Pilih Provinsi --</option>');
        $.each(data, function(index, value) {
            $('#provinsi').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    });

    // Ketika provinsi dipilih → load kabupaten
    $('#provinsi').on('change', function() {
        var provinsiId = $(this).val();
        var provinsiNama = $('#provinsi option:selected').text();
        $('#provinsi_nama').val(provinsiNama);

        $('#kabupaten').empty().append('<option value="">-- Pilih Kabupaten / Kota --</option>');
        $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
        $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>');

        if (provinsiId) {
            $.get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'+ provinsiId +'.json', function(data) {
                $.each(data, function(index, value) {
                    $('#kabupaten').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            });
        }
    });

    // Ketika kabupaten dipilih → load kecamatan
    $('#kabupaten').on('change', function() {
        var kabupatenId = $(this).val();
        var kabupatenNama = $('#kabupaten option:selected').text();
        $('#kabupaten_nama').val(kabupatenNama);

        $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
        $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>');

        if (kabupatenId) {
            $.get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/'+ kabupatenId +'.json', function(data) {
                $.each(data, function(index, value) {
                    $('#kecamatan').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            });
        }
    });

    // Ketika kecamatan dipilih → load kelurahan
    $('#kecamatan').on('change', function() {
        var kecamatanId = $(this).val();
        var kecamatanNama = $('#kecamatan option:selected').text();
        $('#kecamatan_nama').val(kecamatanNama);

        $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>');

        if (kecamatanId) {
            $.get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/'+ kecamatanId +'.json', function(data) {
                $.each(data, function(index, value) {
                    $('#kelurahan').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            });
        }
    });

    // Ketika kelurahan dipilih → set hidden nama
    $('#kelurahan').on('change', function() {
        var kelurahanNama = $('#kelurahan option:selected').text();
        $('#kelurahan_nama').val(kelurahanNama);
    });
});
