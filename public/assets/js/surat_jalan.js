$(document).ready(function(){
//=============================================cari resi
		$('#carinoresi').select2({
		placeholder: 'Cari nomor resi',
		ajax:{
			url:'/carinoresi',
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
			var isi = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/cariresi/'+isi,
                success:function (data){
				return {
					results : $.map(data, function (item){
					
							cariitem(item.nama_barang,item.jumlah,item.berat);
					})
				}
			},
            });
		});
		//===================================================
		$("#carinoresi").on('select2:close',function(e){
			$('#penerima').focus();
		});
	//===================================================
	function cariitem(barang,jumlah,berat){
		$('#isipaket').val(barang);
		$('#jumlah').val(jumlah);
		$('#berat').val(berat);

	}

});