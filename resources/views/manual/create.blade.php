@extends('layout.masteradmin')

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
var limit = 10; // limit

//fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Limit hanya " + counter + " inputan");
 }
 else {
    var newdiv = document.createElement('div');
    newdiv.innerHTML =' <div id="input'+counter+'" class="">'+
				'<div class="row">'+
					'<p id="no1'+counter+'"></p>'+
					'<div class="col-lg-4">'+
						'<fieldset class="form-group">'+
							'<label class="form-label semibold" for="exampleInput">Kode</label>'+
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
							<h2>Input Manual</h2>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<form action="{{ url('Manual') }}" role="form" method="POST">
					<label class="form-label" for="exampleInputDisabled">Pemegang</label>
					<select class="select2" name="pemegang">
						@foreach($karyawan as $kar)
						<option value="{{$kar->id}}">
							{{$kar->nama}}
						</option>
						@endforeach
					</select>
					<br><br>
<!--  -->
<div id="dynamicInput">
</div>
<!--  -->

<button type="button" onClick="addInput('dynamicInput');" class="btn btn-warning btn-sm"><i class="fa fa-plus"> Masukan Kode</i></button>
<br>
<hr></hr>


{{csrf_field()}}
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