$(document).ready(function(){
	//=============================================cari resi
	$('#carinoresi').select2({
		placeholder: 'Cari nomor resi',
		ajax:{
			url:'/carinoresipenerimaan',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						
						return {
							id: item.id,
							text: item.no_resi
						}

					})
				}
			},
			cache: true
		}
	});

	//=================================================
	$('#carinoresi').on('select2:select',function(e){
        $('#panelnya').loading('toggle');
		var isi = $(this).val();
		$.ajax({
            type: 'GET',
            url: '/cariresi/'+isi,
            success:function (data){
				return{
					results : $.map(data, function (item){
					cariitem(item.pengiriman_via,item.total_berat_udara,item.id,item.nama_barang,item.jumlah,item.berat,item.nama_pengirim,item.nama_penerima,item.kode_tujuan);
					})
				}
			},complete:function(){
                $('#panelnya').loading('stop');
            }
        });
	});

	//===================================================
	function cariitem(via,beratudara,idresi,barang,jumlah,berat,pengirim,penerima,tujuan){
        $('#penerima').val(penerima);
        $('#pengirim').val(pengirim);
		$('#isipaket').val(barang);
        $('#tujuan').val(tujuan);
		$('#jumlah').val(jumlah);
		if(via=='udara'){
            $('#berat').val(beratudara);
        }else{
            $('#berat').val(berat); 
        }
		$('#idresi').val(idresi);

	}
});