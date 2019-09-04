@extends('layout.masteradminnew')
@section('header')
@foreach($title as $row)
<title>{{$row->namaweb}}</title>
<link href="{{asset('img/setting/'.$row->icon)}}" rel="icon" type="image/png">
@endforeach
@endsection
@section('css')
<link href="{{asset('assets/css/lib/charts-c3js/c3.min.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="{{asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/vendor/lobipanel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/separate/pages/widgets.min.css')}}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <h4>Transfer Ke Pusat</h4>                
            </div>
            <div class="row">
                <div class="col-xl-6 dahsboard-column">
                    <section class="widget widget-time">
                       <header class="widget-header-dark with-btn">
                           Jumlah Saldo Pendapatan Total                           
                       </header>
                       <div class="widget-time-content">

                       </div>
                    </section>
                </div>
                 <div class="col-xl-6 dahsboard-column">
                    <section class="widget widget-time">
                       <header class="widget-header-dark with-btn">
                           Jumlah Saldo Pengeluaran Total                           
                       </header>
                       <div class="widget-time-content">
                            
                       </div>
                    </section>
                </div>
            </div>
        </div>
    </div>    
@endsection
