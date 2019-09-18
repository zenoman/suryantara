$(document).ready(function(){
	//=============================================cari resi
		$('#carinoresi').select2({
		placeholder: 'Cari nomor resi',
		ajax:{
			url:'/carinoresibelumlunas',
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
				return {
					results : $.map(data, function (item){
					cariitem(item.kekurangan,item.pengiriman_via,item.total_berat_udara,item.id,item.total_biaya,item.total_bayar,item.nama_barang,item.jumlah,item.berat,item.nama_pengirim,item.nama_penerima,item.kode_tujuan);
					})
				}
			},complete:function(){
                $('#panelnya').loading('stop');
            }
            });
		});
	//===================================================
	function cariitem(kekurangan,via,beratudara,idresi,totalbiaya,totalbayar,barang,jumlah,berat,pengirim,penerima,tujuan){
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
		$('#tampil_total_biaya').html("Rp. "+rupiah(totalbiaya));
		$('#totalbiaya').val(totalbiaya);
		$('#tampil_total_bayar').html("Rp. "+rupiah(totalbayar));
		$('#tampil_total_kekurangan').html("Rp. "+rupiah(kekurangan));
		$('#totalkekurangan').val(kekurangan);
		$('#totalbayar').val(totalbayar);
		$('#idresi').val(idresi);
		$('#inputbayar').focus();

	}
	//==================================================
        function rupiah(bilangan){
            var number_string = bilangan.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

            return rupiah;
        }
    //==================================================
    $('#inputbayar').on('change',function(e){
		var bayar = this.value;
		var total = $('#totalkekurangan').val();

		if(parseInt(bayar) >= parseInt(total)){
			$('#kembalian').val("Rp. "+rupiah(bayar-total));
			$('#statuslunas').val('lunas');
		}else{
			$('#kembalian').val("Rp. 0");
			$('#statuslunas').val('belum_lunas');
		}
	})
});