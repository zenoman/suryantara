@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection

@section('content')
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<script language="Javascript" type="text/javascript">
//fungsi remove html
//====================================================
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
//====================================================

var counter = 1; //variabel nomor inputan
var limit = 5; // limit

//fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Limit hanya " + counter + " inputan");
 }
 else {
    var newdiv = document.createElement('div');
    newdiv.innerHTML =' <div id="input'+counter+'" class="">'+
				 '<div class="form-group row">'+
						'<label class="col-sm-2 form-control-label semibold">&nbsp;</label>'+
						'<div class="col-sm-8">'+
							'<div class="input-group">'+
								'<input type="text" class="form-control" id="exampleInput" placeholder="Contoh : Pajak Tahunan" name="pajak[]">'+
							'</div>'+
						'</div>'+
						'<div class="col-sm-2">'+
							'<div class="input-group text-center">'+
							'<a href="#" class="btn btn-danger btn-block" onclick="del('+counter+')"><i class="fa fa-remove"></i></a>'+
						'</div>'+
						'</div>'+
					'</div>'+		
                '</div>';

    document.getElementById(divName).appendChild(newdiv);
    counter++;
 }

}
//fungsi hapus input
function del(no) {
  document.getElementById('input'+no).remove();
  counter = counter - 1;
  for(i=no;i<=limit;i++){
    var id = document.getElementById('input'+i);
    if (id === null){

    } else {

    }
  }
}
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Data Armada</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('armada') }}" role="form" method="POST">
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Nama Kendaraan</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input 
								type="text" 
								class="form-control" 
								placeholder="Contoh : Daihatsu Gran Max" name="nama"
								required 
								>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Polisi</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nopol" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Rangka</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="norangka" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">No. Mesin</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="nomesin" 
								required>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Warna</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input
								type="text"
								class="form-control"
								name="warna" 
								required 
								placeholder="Contoh : Merah">
							</div>
						</div>
					</div>
					{{csrf_field()}}
					<hr>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label semibold">Pajak Kendaraan</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" id="exampleInput" placeholder="Contoh : Pajak Tahunan" name="pajak[]">
							</div>
						</div>
						<div class="col-sm-2">
							<div class="input-group">
							<button type="button" onClick="addInput('dynamicInput');" class="btn btn-warning btn-block"><i class="fa fa-plus"></i></button>
						</div>
						</div>
					</div>				
<div id="dynamicInput">
</div>
<!--  -->

					<div class="text-right">
						<input class="btn btn-primary" type="submit" name="submit" value="simpan">
						<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
					</div>
				</form>
			</div>
			</div>
			</div>
        @endsection
