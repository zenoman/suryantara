$(document).ready(function(){
	var halaman='darat';
	//======================================
	$('#metode').on('change',function(e){
		halaman = this.value;
		if(halaman=='darat'){
		 $("#formdarat").show(700);
         $("#formudara").hide(700);
         $("#formlaut").hide(700);	
		}else if(halaman=='laut'){
		 $("#formdarat").hide(700);
         $("#formudara").hide(700);
         $("#formlaut").show(700);
		}else{
		 $("#formdarat").hide(700);
         $("#formudara").show(700);
         $("#formlaut").hide(700);
		}
	});

});