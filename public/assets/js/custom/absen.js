$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

//---------------------

//------------------------TAMBAH--------------------------
    $("#masuk").click(function(e){

                $('#halinput').loading('toggle');
                $("#forminput").submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();    
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/Absen',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function () {
                       $.bootstrapGrowl('<h4><strong>Pemberitahuan</strong></h4> <p>Data berhasi disimpan</p>', {
                        type: 'success',
                        delay: 3000,
                        allow_dismiss: true,
                        offset: {from: 'top', amount: 20}
                        });
                    getData(1);
                    $("#halinput").hide(700);
                    $("#halinput").show(700);
                    $("#id_karyawa").val('');
                    $("#id_jabatan").val('');
                    $("#tanggal").val('');
                    $("#bulan").val('');
                    $("#tahun").val('');
                    },
                    complete: function (data) {
                      $('#halinput').loading('stop');
                     }
                });
            });
});
