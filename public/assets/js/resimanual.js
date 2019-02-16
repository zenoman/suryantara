$(document).ready(function(){
	var halaman='darat';
	var satuan_darat = 'kg';
	var satuan_laut = 'kg';
	var satuan_udara = 'kg';
	var kategori_udara ='biasa';
	var kotatujuanudara = '';
	//======================================
	$('#metode').on('change',function(e){
		halaman = this.value;
		if(halaman=='darat'){
		 $("#formdarat").show(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);	
		 $('#nama_barang_darat').focus();
		}else if(halaman=='laut'){
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").show(700);
		 $('#nama_barang_laut').focus();
		}else{
		 $("#formdarat").hide(700);
         $("#formudara").show(700);
         $("#formlaut").hide(700);
         $('#nama_barang_udara').focus();
		}
	});
	//###############################halaman darat
	$('#satuan_darat').on('change',function(e){
		satuan_darat = this.value;
	})
	//============================================ hitung volumetrik
		$("#d_panjang_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang = $("#d_panjang_darat").val();
			var lebar = $("#d_lebar_darat").val();
			var tinggi = $("#d_tinggi_darat").val();
			var total =  (parseInt(panjang) *  parseInt(lebar) *  parseInt(tinggi))/4000;
			var vt = parseFloat(total);
			$("#volume_darat").val(vt.toFixed(2));
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_darat').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carikota',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.tujuan
						}

					})
				}
			},
			cache: true
		}
	});
	//=================================================
	$('#kota_tujuan_darat').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilkota/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_darat=='kg'){
								hitung(item.tarif,item.tujuan);
							}else{
								$("#biaya_kirim_darat").val(0);
								$("#b_kirim_darat").html(0);
								hitung_total();
							}
					})
				}
			},
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung(harga,tujuan){
			var berat = $("#berat_darat").val();
			if(berat!=''){
			var jumlah = harga*berat;
			var ppn = (jumlah*1)/100;
			$("#biaya_kirim_darat").val(jumlah);
			$("#b_kirim_darat").html(rupiah(jumlah));
			$("#b_ppn_darat").html(rupiah(ppn));
			hitung_total();		
		}}
	//==================================================
		function rupiah(bilangan){
			var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

			return rupiah;
		}
	//============================================ hitung total biaya
		function hitung_total(){
			var b_kirim = $("#biaya_kirim_darat").val();
			var b_packing = $("#biaya_packing_darat").val();
			var b_asuransi = $("#biaya_asuransi_darat").val();
			var b_ppn		= $("#b_ppn_darat").html().replace(/\./g,'');
			var totalnya = parseInt(b_ppn)+parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#total_darat").html(rupiah(totalnya));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_darat").val();
			$("#b_asuransi_darat").html(rupiah(biaya_asu));
			hitung_total();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_darat").val();
			var ppn = (biaya_kirim*1)/100;
			$("#b_kirim_darat").html(rupiah(biaya_kirim));
			$("#b_ppn_darat").html(rupiah(ppn));
			hitung_total();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_darat").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_darat").val();
			$("#b_packing_darat").html(rupiah(biaya_pack));
			hitung_total();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_darat").on('select2:close',function(e){
			$('#n_pengirim_darat').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_darat").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_darat").val();
			var d_panjang	= $("#d_panjang_darat").val();
			var d_tinggi	= $("#d_tinggi_darat").val();
			var d_lebar		= $("#d_lebar_darat").val();
			var volume		= $("#volume_darat").val();
			var jumlah		= $("#jumlah_darat").val();
			var berat		= $("#berat_darat").val();
			var kota_asal	= $("#kota_asal_darat").val();
			var dats = $('#kota_tujuan_darat').select2('data');
			var kota_tujuan = dats[0].text;
			var a_pengirim 	= $("#alamat_pengirim_darat").val();
			var a_penerima	= $("#alamat_penerima_darat").val();
			var n_pengirim 	= $("#n_pengirim_darat").val();
			var t_pengirim	= $("#t_pengirim_darat").val();
			var n_penerima	= $("#n_penerima_darat").val();
			var t_penerima 	= $("#t_penerima_darat").val();
			var biaya_kirim	= $("#biaya_kirim_darat").val();
			var biaya_packing = $("#biaya_packing_darat").val();
			var biaya_asu 	= $("#biaya_asuransi_darat").val();
			var keterangan 	= $.trim($("#keterangan_darat").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_darat').val();
			var ppn 		= $('#b_ppn_darat').text().replace(/\./g,'');
			var total_biaya = parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_darat").val();
			if(a_penerima=='' || a_pengirim=='' || nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanualdarat',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idresi'		: idresi,
                    'iduser'		: iduser,
                    'nama_barang'	: nama_barang,
					'dimensi'		: dimensi,
					'ukuran_volume'	: volume,
					'jumlah'		: jumlah,
					'berat'			: berat,
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'biaya_packing'	: biaya_packing,
					'biaya_asu' 	: biaya_asu,
					'keterangan'	: keterangan,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	window.location.href = "/Manual";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});



	//###############################halaman laut
	$('#satuan_laut').on('change',function(e){
		satuan_laut = this.value;
	})
	//============================================ hitung volumetrik
		$("#d_panjang_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_laut = $("#d_panjang_laut").val();
			var lebar_laut = $("#d_lebar_laut").val();
			var tinggi_laut = $("#d_tinggi_laut").val();
			var total_laut =  (parseInt(panjang_laut) *  parseInt(lebar_laut) *  parseInt(tinggi_laut))/4000;
			var vt = parseFloat(total_laut);
			$("#volume_laut").val(vt.toFixed(2));
			}
			
		})
	//=============================================cari kota tujuan
		$('#kota_tujuan_laut').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/carilaut',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.tujuan
						}

					})
				}
			},
			cache: true
		}
	});
	//=================================================
	$('#kota_tujuan_laut').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasillaut/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							if(satuan_laut=='kg'){
								hitung_laut(item.tarif,item.tujuan);
							}else{
								$("#biaya_kirim_laut").val(0);
								$("#b_kirim_laut").html(0);
								hitung_total_laut();
							}
					})
				}
			},
            });
		});
	//============================================ hitung estimasi tujuan
		function hitung_laut(harga,tujuan){
			var berat = $("#berat_laut").val();
			if(berat!=''){
			var jumlah = harga*berat;
			var ppn = (jumlah*1)/100;
			$("#biaya_kirim_laut").val(jumlah);
			$("#b_kirim_laut").html(rupiah(jumlah));
			$("#b_ppn_laut").html(rupiah(ppn));
			hitung_total_laut();		
		}}
	//============================================ hitung total biaya
		function hitung_total_laut(){
			var b_kirim = $("#biaya_kirim_laut").val();
			var b_packing = $("#biaya_packing_laut").val();
			var b_asuransi = $("#biaya_asuransi_laut").val();
			var b_ppn		= $("#b_ppn_laut").html().replace(/\./g,'');
			var totalnya = parseInt(b_ppn)+parseInt(b_kirim) + parseInt(b_packing) + parseInt(b_asuransi);
			$("#total_laut").html(rupiah(totalnya));
		}
	//============================================ hitung total biaya
		$("#biaya_asuransi_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_asu = $("#biaya_asuransi_laut").val();
			$("#b_asuransi_laut").html(rupiah(biaya_asu));
			hitung_total_laut();	
			}
			
		})
	//============================================ hitung total
		$("#biaya_kirim_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_laut").val();
			var ppn = (biaya_kirim*1)/100;
			$("#b_kirim_laut").html(rupiah(biaya_kirim));
			$("#b_ppn_laut").html(rupiah(ppn));
			hitung_total_laut();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_packing_laut").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_pack = $("#biaya_packing_laut").val();
			$("#b_packing_laut").html(rupiah(biaya_pack));
			hitung_total_laut();		
			}
			
		})
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_laut").on('select2:close',function(e){
			$('#n_pengirim_laut').focus();
		});
	//============================================ simpan transaksi
		$("#btnsimpan_laut").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_laut").val();
			var d_panjang	= $("#d_panjang_laut").val();
			var d_tinggi	= $("#d_tinggi_laut").val();
			var d_lebar		= $("#d_lebar_laut").val();
			var volume		= $("#volume_laut").val();
			var jumlah		= $("#jumlah_laut").val();
			var berat		= $("#berat_laut").val();
			var kota_asal	= $("#kota_asal_laut").val();
			var dats = $('#kota_tujuan_laut').select2('data');
			var kota_tujuan = dats[0].text;
			var a_pengirim 	= $("#alamat_pengirim_laut").val();
			var a_penerima	= $("#alamat_penerima_laut").val();
			var n_pengirim 	= $("#n_pengirim_laut").val();
			var t_pengirim	= $("#t_pengirim_laut").val();
			var n_penerima	= $("#n_penerima_laut").val();
			var t_penerima 	= $("#t_penerima_laut").val();
			var biaya_kirim	= $("#biaya_kirim_laut").val();
			var biaya_packing = $("#biaya_packing_laut").val();
			var biaya_asu 	= $("#biaya_asuransi_laut").val();
			var keterangan 	= $.trim($("#keterangan_laut").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_laut').val();
			var ppn 		= $('#b_ppn_laut').text().replace(/\./g,'');
			var total_biaya = parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_packing) +  parseInt(biaya_asu);
			var metode		= $("#metode_laut").val();
			if(a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_packing=='' || biaya_asu =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanuallaut',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idresi'		: idresi,
                    'iduser'		: iduser,
                    'nama_barang'	: nama_barang,
					'dimensi'		: dimensi,
					'ukuran_volume'	: volume,
					'jumlah'		: jumlah,
					'berat'			: berat,
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'biaya_packing'	: biaya_packing,
					'biaya_asu' 	: biaya_asu,
					'keterangan'	: keterangan,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	window.location.href = "/Manual";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});



	//###############################halaman udara
	//=============================================ganti satuan	
	$('#satuan_udara').on('change',function(e){
		satuan_udara = this.value;
	})
	//=============================================ganti kategori	
	$('#kategori_udara').on('change',function(e){
		kategori_udara = this.value;
	})
	//===========================================
		$('#kota_tujuan_udara').select2({
		placeholder: 'Cari kota tujuan',
		ajax:{
			url:'/cariudara',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.id,
							text: item.tujuan+" - "+item.airlans
						}

					})
				}
			},
			cache: true
		}
	});
		//=================================================
	$('#kota_tujuan_udara').on('select2:select',function(e){
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasiludara/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
							$('#min_heavy').val(item.minimal_heavy);
							
							if(satuan_udara == 'kg'){
								if(parseInt($('#min_heavy').val()) < parseInt($('#berat_udara').val())){
								$('#status_udara').val('Heavy Cargo');
								$('#biaya_kirim_udara').val(0);
								$('#b_kirim_udara').html(0);
								$('#b_ppn_udara').html(0);
								$('#b_charge_udara').html(0);
								}else{
								if (kategori_udara=='biasa'){
									$('#status_udara').val('Normal Cargo');
									var berat = $('#berat_udara').val();
									var jumlah  = item.perkg*berat;
									var ppn		= (jumlah*1)/100;
									$('#b_charge_udara').html(0);
									$('#biaya_kirim_udara').val(jumlah);
									$('#b_kirim_udara').html(rupiah(jumlah));
									$('#b_ppn_udara').html(rupiah(ppn));
								}else{
									$('#status_udara').val('Normal Cargo');
									var berat = $('#berat_udara').val();
									var jumlah  = item.perkg*berat;
									var ppn		= (jumlah*1)/100;
									var totalcarge = (jumlah*kategori_udara)/100;
									$('#b_charge_udara').html(rupiah(totalcarge));
									$('#biaya_kirim_udara').val(jumlah);
									$('#b_kirim_udara').html(rupiah(jumlah));
									$('#b_ppn_udara').html(rupiah(ppn));
								}
								
							}
							}else{
								if(parseInt($('#min_heavy').val()) < parseInt($('#berat_udara').val())){
								$('#status_udara').val('Heavy Cargo');
								}else{
								$('#status_udara').val('Normal Cargo');
								}
								$('#biaya_kirim_udara').val(0);
								$('#b_kirim_udara').html(0);
								$('#b_ppn_udara').html(0);
								$('#b_charge_udara').html(0);
							}
							kotatujuanudara = item.tujuan;
							$('#biaya_smu_udara').val(item.biaya_dokumen);
							$('#b_smu_udara').html(rupiah(item.biaya_dokumen));
							hitung_total_udara();
					})
				}
				
			},
            });
		});
	//============================================ fokus input pengirim 	
		$("#kota_tujuan_udara").on('select2:close',function(e){
			$('#nomer_smu_udara').focus();
		});
	//==============================================
	function hitung_total_udara(){
		var biaya_kirim = parseInt($('#biaya_kirim_udara').val());
		var biaya_dokumen = parseInt($('#biaya_smu_udara').val());
		var biaya_karantina = parseInt($('#biaya_karantina_udara').val());
		var biaya_ppn 		= parseInt($('#b_ppn_udara').text().replace(/\./g,''));
		var biaya_charge = parseInt($('#b_charge_udara').text().replace(/\./g,''));
		var jumlah = biaya_kirim + biaya_charge + biaya_dokumen + biaya_karantina + biaya_ppn;
		$('#total_udara').html(rupiah(jumlah));
	}
	//============================================ hitung volumetrik
		$("#d_panjang_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_udara = $("#d_panjang_udara").val();
			var lebar_udara = $("#d_lebar_udara").val();
			var tinggi_udara = $("#d_tinggi_udara").val();
			var total_udara =  (parseInt(panjang_udara) *  parseInt(lebar_udara) *  parseInt(tinggi_udara))/6000;
			var vt = parseFloat(total_udara);
			$("#volume_udara").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_lebar_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_udara = $("#d_panjang_udara").val();
			var lebar_udara = $("#d_lebar_udara").val();
			var tinggi_udara = $("#d_tinggi_udara").val();
			var total_udara =  (parseInt(panjang_udara) *  parseInt(lebar_udara) *  parseInt(tinggi_udara))/6000;
			var vt = parseFloat(total_udara);
			$("#volume_udara").val(vt.toFixed(2));
			}
			
		})
	//============================================ hitung volumetrik
		$("#d_tinggi_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var panjang_udara = $("#d_panjang_udara").val();
			var lebar_udara = $("#d_lebar_udara").val();
			var tinggi_udara = $("#d_tinggi_udara").val();
			var total_udara =  (parseInt(panjang_udara) *  parseInt(lebar_udara) *  parseInt(tinggi_udara))/6000;
			var vt = parseFloat(total_udara);
			$("#volume_udara").val(vt.toFixed(2));
			}
			
		})
	//==============================================
		$("#biaya_kirim_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_kirim = $("#biaya_kirim_udara").val();
			var ppn = (biaya_kirim*1)/100;
			if (kategori_udara!='biasa'){
			var charge = (biaya_kirim*kategori_udara)/100;	
			$('#b_charge_udara').html(rupiah(charge));
			}else{
			$('#b_charge_udara').html(0);
			}
			$("#b_kirim_udara").html(rupiah(biaya_kirim));
			$("#b_ppn_udara").html(rupiah(ppn));
			hitung_total_udara();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_smu_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_smu = $("#biaya_smu_udara").val();
			$("#b_smu_udara").html(rupiah(biaya_smu));
			hitung_total_udara();		
			}
			
		})
	//============================================ hitung total	
		$("#biaya_karantina_udara").keydown( function(e){
			if(e.keyCode == 9 && !e.shiftKey){
			var biaya_karantina = $("#biaya_karantina_udara").val();
			$("#b_karantina_udara").html(rupiah(biaya_karantina));
			hitung_total_udara();		
			}
			
		})
	//========================================================
	$("#btnsimpan_udara").click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var idresi		= $("#idresi").val();
			var iduser		= $("#iduser").val();
			var nama_barang	= $("#nama_barang_udara").val();
			var d_panjang	= $("#d_panjang_udara").val();
			var d_tinggi	= $("#d_tinggi_udara").val();
			var d_lebar		= $("#d_lebar_udara").val();
			var volume		= $("#volume_udara").val();
			var jumlah		= $("#jumlah_udara").val();
			var berat		= $("#berat_udara").val();
			var kota_asal	= $("#kota_asal_udara").val();
			var kota_tujuan = kotatujuanudara;
			var n_pengirim 	= $("#n_pengirim_udara").val();
			var t_pengirim	= $("#t_pengirim_udara").val();
			var n_penerima	= $("#n_penerima_udara").val();
			var t_penerima 	= $("#t_penerima_udara").val();
			var biaya_kirim	= $("#biaya_kirim_udara").val();
			var a_pengirim 	= $("#alamat_pengirim_udara").val();
			var a_penerima	= $("#alamat_penerima_udara").val();
			var biaya_smu = $("#biaya_smu_udara").val();
			var biaya_karantina = $("#biaya_karantina_udara").val();
			var keterangan 	= $.trim($("#keterangan_udara").val());
			var dimensi		= d_panjang+" x "+d_lebar+" x "+d_tinggi;
			var satuan		= $('#satuan_udara').val();
			var ppn 		= $('#b_ppn_udara').text().replace(/\./g,'');
			var change		= $('#b_charge_udara').text().replace(/\./g,'');
			var total_biaya = parseInt(change) + parseInt(ppn) + parseInt(biaya_kirim) +  parseInt(biaya_smu) +  parseInt(biaya_karantina);
			var metode		= $("#metode_udara").val();
			var nosmu 		= $('#nomer_smu_udara').val();
			if(a_pengirim==''||a_penerima==''||nama_barang == '' || d_panjang =='' || d_lebar=='' || d_tinggi=='' || volume=='' || jumlah=='' || berat=='' || kota_asal=='' || kota_tujuan=='' || n_pengirim=='' || t_pengirim=='' || n_penerima=='' || t_penerima=='' || biaya_kirim==0 || biaya_smu=='' || biaya_karantina =='' || keterangan==''){
				notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
   			}else{
   				var l = Ladda.create(this);
                l.start();
				$.ajax({
                type: 'POST',
                url: '/simpanmanualudara',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idresi'		: idresi,
                    'iduser'		: iduser,
                    'nama_barang'	: nama_barang,
					'dimensi'		: dimensi,
					'ukuran_volume'	: volume,
					'jumlah'		: jumlah,
					'berat'			: berat,
					'kota_asal'		: kota_asal,
					'kota_tujuan' 	: kota_tujuan,
					'n_pengirim' 	: n_pengirim,
					't_pengirim'	: t_pengirim,
					'n_penerima'	: n_penerima,
					't_penerima'	: t_penerima,
					'biaya_kirim'	: biaya_kirim,
					'biaya_smu'		: biaya_smu,
					'biaya_karantina' : biaya_karantina,
					'keterangan'	: keterangan,
                	'total_biaya'	: total_biaya,
                	'satuan'		: satuan,
                	'metode'		: metode,
                	'ppn'			: ppn,
                	'nosmu'			: nosmu,
                	'charge'		: change,
                	'alamat_pengirim' : a_pengirim,
                	'alamat_penerima' : a_penerima
                },
                success:function(){
                    notie.alert(1, 'Data Disimpan', 2);
                	window.location.href = "/Manual";
                },
            }).always(
            function() {
                l.stop();
            });
			}
		});
});