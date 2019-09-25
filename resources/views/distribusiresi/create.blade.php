@extends('layout.masteradminnew')

@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/select2.min.css')}}">
@endsection
@section('content')
<!--  -->
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
var limit = 16;
//fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Limit hanya 15 inputan");
 }
 else {
    var newdiv = document.createElement('div');
    newdiv.innerHTML =' <div id="input'+counter+'" class="">'+
				'<div class="row">'+
					'<p id="no1'+counter+'"></p>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group">'+
							'<label class="form-label semibold" for="exampleInput">Kode Ke-'+counter+'</label>'+
		'<input type="text" class="form-control" id="exampleInput" placeholder="Masukan No Resi Manual" name="kode[]">'+
						'</fieldset>'+
					'</div>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group"><p>'+
						'<label class="form-label semibold" for="exampleInputPassword1" > Hapus</label>'+
						'<a href="#" onclick="del('+counter+')"><button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button></a>'+
						'</fieldset>'+
					'</div>'+
				'</div>'+
                '</div>';;

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
<!--  -->
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div class="page-content">
		<div class="container-fluid">
<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Input Distribusi Resi</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('distribusiresi') }}" role="form" method="POST">
					<label class="form-label" for="exampleInputDisabled">Cabang</label>
					<select class="select2" name="cabang">
						@foreach($cabang as $row)
							<option value="{{$row->id}}">{{$row->nama}}</option>
						@endforeach
					</select>
					<br><br>
					<div id="dynamicInput"></div>
					<button type="button" onClick="addInput('dynamicInput');" class="btn btn-warning btn-sm"><i class="fa fa-plus"> Masukan Kode</i></button>
					<br><br>
					<label class="form-label" for="exampleInputDisabled">Status</label>
					<select class="form-control" name="status">
							<option value="N">Tidak Aktiv</option>
							<option value="Y">Aktiv</option>
					</select>
					<hr></hr>
					{{csrf_field()}}
					<input type="hidden" name="pembuat" value="{{Session::get('username')}}">
							<small class="text-muted">
								<input class="btn btn-primary" type="submit" name="submit" value="simpan">
								<a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
							</small>
				</form>
			</div>
			</div>
			</div>
        @endsection
		@section('js')
		<script src="{{asset('assets/js/lib/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/class.php')}}"></script>

	@endsection