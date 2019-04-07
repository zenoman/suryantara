$(document).ready(function(){
	var noresisj;
    var jumlahbarang=0;
		carikode();
        $("#carivendor").focus();
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
    //=============================================cari vendor
        $('#carivendor').select2({
        placeholder: 'Cari vendor',
        ajax:{
            url:'/carivendor',
            dataType:'json',
            delay:250,
            processResults: function (data){
                return {
                    results : $.map(data, function (item){
                        
                        return {
                            id: item.id,
                            text: item.vendor
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
					cariitem(item.nama_barang,item.jumlah,item.berat,item.nama_pengirim,item.nama_penerima,item.kode_tujuan);
					})
				}
			},complete:function(){
                $('#panelnya').loading('stop');
            }
            });
		});
    //=================================================
        $('#carivendor').on('select2:select',function(e){
            $('#panelnya').loading('toggle');
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/carivendor/'+id,
                success:function (data){
                return {
                    results : $.map(data, function (item){
                        $('#telpvendor').val(item.telp);
                        $('#alamatvendor').val(item.alamat);
                        $('#cabang').val(item.cabang);
                        $("#cetak_tujuan").html(":&nbsp;"+item.vendor+"("+item.telp+")");
                        $("#cetak_tujuan2").html(":&nbsp;"+item.vendor+"("+item.telp+")");
                        $("#cetak_alamat").html(":&nbsp;"+item.alamat);
                        $("#cetak_alamat2").html(":&nbsp;"+item.alamat);
                        $('#carinoresi').focus();
                    })
                }
            },complete:function(){
                $('#panelnya').loading('stop');
            }
            });
        });
	//===================================================
		$("#carinoresi").on('select2:close',function(e){
			$('#penerima').focus();
		});
	//===================================================
	function cariitem(barang,jumlah,berat,pengirim,penerima,tujuan){
        $('#penerima').val(penerima);
        $('#pengirim').val(pengirim);
		$('#isipaket').val(barang);
        $('#tujuan').val(tujuan);
		$('#jumlah').val(jumlah);
		$('#berat').val(berat);
        $('#btntambah').focus();
	}
	//========================================================
	function carikode(){
        $('#panelnya').loading('toggle');
			$.ajax({
			url:'/carikodesj',
			dataType:'json',
			success:function(data){
				noresisj = data;
				$("#noresi").html(data);
                 $("#cetak_kodesj").html(":&nbsp;"+data);
                 $("#cetak_kodesj2").html(":&nbsp;"+data);
				getdata();
			}
		});
		}
	//==============================================================
    function hapusdetail(id){
    var foo = "bar";
    if(foo=="bar"){
    	var isgood = confirm('Dialogue');
    	if(isgood){
    		alert(id);	
    	}else{
    		alert('cancel');
    	}
    }
    }
	//========================================================
	 function getdata(){
            $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/caridetailsj/'+noresisj,
                    success:function(data){
                        managerow(data);
                    },error:function(){
                        console.log(data);
                        alert('error');
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
            var totalkg =0;
            var totalcash = 0;
            var totalbt = 0;
            var no = 0;
            $.each(data,function(key, value){
                no +=1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' +value.no_resi+'</td>';
                rows = rows + '<td>'+value.nama_pengirim+'</td>';
                rows = rows + '<td>' +value.nama_penerima+'</td>';
                rows = rows + '<td>' +value.kode_tujuan+'</td>';
                rows = rows + '<td class="text-center">' +value.jumlah+'</td>';
                rows = rows + '<td class="text-center">' +value.berat+'</td>';
                rows = rows + '<td>' +value.nama_barang+'</td>';
                rows = rows + '<td><button type="button" class="btn btn-warning" onclick="halo('+value.id+')"><i class="fa fa-trash"></i></button></td>';
                rows = rows + '</tr>';
                totaljumlah += value.jumlah;
                totalkg += Number(value.berat);

                rows2 = rows2 + '<tr align="center">';
                rows2 = rows2 + '<td>'+no+'</td>';
                rows2 = rows2 + '<td>'+value.no_resi+'</td>';
                if(value.pengiriman_via=='udara'){
                   if(value.no_smu==null){
                        rows2 = rows2 + '<td align="center"> </td>';
                    }else{
                      rows2 = rows2 + '<td>'+value.no_smu+'</td>';
                    }
                }else{
                    rows2 = rows2 + '<td align="center"> - </td>';
                }
                rows2 = rows2 + '<td>'+value.nama_pengirim+'</td>';
                rows2 = rows2 + '<td>'+value.nama_penerima+'</td>';
                rows2 = rows2 + '<td>' +value.kode_tujuan+'</td>';
                rows2 = rows2 + '<td>' +value.jumlah+'</td>';
                rows2 = rows2 + '<td>' +value.berat+'</td>';
                rows2 = rows2 + '<td>' +value.nama_barang+'</td>';
                if(value.metode_bayar=='cash'){
                        rows2 = rows2 + '<td>-</td>';
                        rows2 = rows2 + '<td> </td>';   
                    }else{
                        rows2 = rows2 + '<td> </td>'; 
                        rows2 = rows2 + '<td>-</td>'; 
                    }
                rows2 = rows2 + '<td>-</td>';
                rows2 = rows2 + '</tr>';
                //=======================================
                rows3 = rows3 + '<tr align="center">';
                rows3 = rows3 + '<td>'+no+'</td>';
                rows3 = rows3 + '<td>'+value.no_resi+'</td>';
                if(value.pengiriman_via=='udara'){
                    if(value.no_smu==null){
                        rows3 = rows3 + '<td align="center"> </td>';
                    }else{
                      rows3 = rows3 + '<td>'+value.no_smu+'</td>';
                    }
                }else{
                    rows3 = rows3 + '<td align="center"> - </td>';
                }
                rows3 = rows3 + '<td>'+value.nama_pengirim+'</td>';
                rows3 = rows3 + '<td>'+value.nama_penerima+'</td>';
                rows3 = rows3 + '<td>' +value.kode_tujuan+'</td>';
                rows3 = rows3 + '<td>' +value.jumlah+'</td>';
                rows3 = rows3 + '<td>' +value.berat+'</td>';
                rows3 = rows3 + '<td>' +value.nama_barang+'</td>';
                if(value.metode_bayar=='cash'){
                        rows3 = rows3 + '<td align="left">'+"Rp. "+rupiah(value.total_biaya)+'</td>';
                        rows3 = rows3 + '<td> </td>';
                        totalcash += value.total_biaya;   
                    }else{
                        rows3 = rows3 + '<td> </td>'; 
                        rows3 = rows3 + '<td align="left">'+"Rp. "+rupiah(value.total_biaya)+'</td>'; 
                        totalbt += value.total_biaya;
                    }
                rows3 = rows3 + '<td>-</td>';
                rows3 = rows3 + '</tr>';
                jumlahbarang+=1;
            });
            $("#tubuh").html(rows);
            $("#list_cetak").html(rows2);
            $("#list_cetak2").html(rows3);
            $("#totaljumlah").html(totaljumlah);
            $("#cetak_subtotaljumlah").html(totaljumlah);
            $("#cetak_subtotalberat").html(totalkg);
            $("#cetak_subtotaljumlah2").html(totaljumlah);
            $("#cetak_subtotalberat2").html(totalkg);
            $("#totalkg").html(totalkg);
            $('#totalcash').val(totalcash);
            $('#totalbt').val(totalbt);
            $('#cetak_totalcashnya').html("Rp. "+rupiah(totalcash));
            $('#cetak_totalbtnya').html("Rp. "+rupiah(totalbt));

        }
    //============================================================
    $("#btntambah").click(function(e){
        if($('#pengirim').val()==''){
                notie.alert(3, 'Maaf, Data Resi Harus Diisi', 2);
            }else{
               var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('Tambahkan Resi Kesurat Jalan ? ');
     if(isgood == true){
     $('#panelnya').loading('toggle'); 
        var l = Ladda.create(this);
        l.start();
        var penerima = $("#penerima").val();
        var jumlah = $("#jumlah").val();
        var berat = $("#berat").val();
        var tujuan = $("#tujuan").val();
        var isipaket = $("#isipaket").val();

        if($("#carinoresi").val() =='' ||penerima==''||jumlah==''||berat==''||tujuan==''||isipaket==''){
            notie.alert(3, 'Maaf Data Tidak Boleh Ada Yang Kosong', 2);
        }else{
            var resi = $("#carinoresi").select2('data');
            var noresi = resi[0].id;
            $.ajax({
                type: 'POST',
                url: '/tambahdetailsj',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'kode': noresisj,
                    'noresi': noresi
                },
                success: function(data) {
                     notie.alert(1, 'Data Disimpan', 2);
                     bersihdetail();
                    getdata();
                },complete:function(){
                
                $('#panelnya').loading('stop');
             }
            }).always(
            function() {
                l.stop();
            });
        }}} 
            }
    	
    });
    //=============================================================
    $('#btnbersihdetail').click(function(){
        bersihdetail();
    })
    //===============================================================
    function bersihdetail(){
        $('#pengirim').val('');
    	$("#penerima").val('');
    	$("#jumlah").val('');
    	$("#berat").val('');
    	$("#tujuan").val('');
    	$("#isipaket").val('');
        $("#carinoresi").val(null).trigger('change');
    	$("#carinoresi").focus();
    }
    //==================================================================
    function halo(id){
    var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('hapus ? ');
     if(isgood == true){
        $('#panelnya').loading('toggle');
           $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/hapusdetailsj/'+id,
                    success:function(){
                        notie.alert(3, 'Detail Dihapus', 2);
                        getdata();
                    },error:function(){
                       notie.alert(3, 'Detail Dihapus', 2);
                        getdata();
                    }
                });
     }   
    }
    }
    window.halo=halo;
//===========================
    function cetakresi(){
        if($('#cabang').val()=='Y'){
            var divToPrint=document.getElementById('hidden_divcabang');
        }else{
           var divToPrint=document.getElementById('hidden_div'); 
        }
        
        
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();  
        
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
    //======================================================
    $('#btnselesai').click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var foo = "bar";
    if(foo=="bar"){
        var isgood = confirm('Apakah anda yakin surat jalan telah benar ?');
        if(isgood){
            location.reload();  
        }
    }
        });
    //======================================================
    $('#btnsimpan').click(function(){
    var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('Apakah Anda Yakin Data Sudah Benar ?');
     if(isgood == true){
        if($('#telpvendor').val()=='' || jumlahbarang==0){
                notie.alert(3, 'Maaf, Data Harus Lengkap', 2);
            }else{
                var noresi = $("#noresi").html();
                var dats = $('#carivendor').select2('data');

                var tujuan = dats[0].text+"-"+$("#telpvendor").val();
                var alamat = $("#alamatvendor").val();
                var totalkg = $('#totalkg').html();
                var totalkoli = $('#totaljumlah').html();
                var totalcash = $('#totalcash').val();
                var totalbt    =$('#totalbt').val();
                var cabang = $('#cabang').val();
                var l = Ladda.create(this);
                l.start();
                $.ajax({
                type: 'POST',
                url: '/tambahkansj',
                data: {
                    '_token': $('input[name=_token]').val(),
                        'noresi' : noresi,
                        'tujuan' : tujuan,
                        'alamat' : alamat,
                        'totalkg' : totalkg,
                        'totalkoli' : totalkoli,
                        'totalcash' : totalcash,
                        'totalbt'   : totalbt,
                        'cabang'    : cabang
                },
                success: function() {
                     notie.alert(1, 'Data Disimpan', 2);
                     bersihdetail();
                      
                    cetakresi();
                    $('#carivendor').focus();
                },
            }).always(
            function() {
                l.stop();
            });
    }}}})
});