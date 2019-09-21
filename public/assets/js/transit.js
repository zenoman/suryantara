$(document).ready(function(){
    //====================================================
        $('#carisuratjalan').select2({
        placeholder: 'Cari Surat Jalan',
        ajax:{
            url:'/carisuratjln',
            dataType:'json',
            delay:250,
            processResults: function (data){
                return {
                    results : $.map(data, function (item){
                        
                        return {
                            id: item.id,
                            text: item.kode
                        }

                    })
                }
            },
            cache: true
        }
    });
    //====================================================
        $('#carisuratjalan').on('select2:select',function(e){
            $('#panelnya').loading('toggle');
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/carisuratjln/'+id,
                success:function (data){
                return {
                    results : $.map(data, function (item){
                        $('#tujuan').val(item.tujuan);
                        $('#alamat').val(item.alamat_tujuan);
                        $('#kodejalan').val(item.kode);
                        cariresi(item.kode);
                    })
                }
            }
            });
        });
    //=======================================================
    function cariresi(kode){
         $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/cariresisj/'+kode,
                    success:function(data){
                        managerow(data);
                    },complete:function(){
                $('#panelnya').loading('stop');
            }
                });
    }
    //==========================================================
    function managerow(data){
            var cabang = $('#cabang').val();
            var rows ='';
            var rows2 ='';
            var rows3 ='';
            var totaljumlah =0;
            var jumlahbarang =0;
            var totalkg =0;
            var totalcash = 0;
            var totalbt = 0;
            var no = 0;
            $.each(data,function(key, value){
                var beratnya='';
                if(value.pengiriman_via=='udara'){
                    beratnya=value.total_berat_udara;
                }else{
                    beratnya=value.berat;
                }
                no +=1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' +value.no_resi+'</td>';
                rows = rows + '<td>'+value.nama_pengirim+'</td>';
                rows = rows + '<td>' +value.nama_penerima+'</td>';
                rows = rows + '<td>' +value.kode_tujuan+'</td>';
                rows = rows + '<td class="text-center">' +value.jumlah+'</td>';
                rows = rows + '<td class="text-center">' +beratnya+'</td>';
                rows = rows + '<td>' +value.nama_barang+'</td>';
                rows = rows + '</tr>';

                totaljumlah += value.jumlah;
                totalkg += Number(value.berat);
                totalcash += value.total_biaya;   
                jumlahbarang+=1;
            });
            $("#tubuh").html(rows);
           
            $("#totaljumlah").html(totaljumlah);
           
            $("#totalkg").html(totalkg);
            $('#totalcash').val(totalcash);
            $('#totalbt').val(totalbt);
            

        }

        function valida(){
            if($('#tujuan').val()==''){
                alert('data harus diisi');
                return false;
            }else{
                return true;
            }
        }
        window.valida=valida;
});
