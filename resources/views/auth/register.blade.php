<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Oops</title>

<link rel="stylesheet" href="{{asset('assets/css/separate/pages/error.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>

<div class="page-error-box">
    <div class="error-code">404</div>
    <div class="error-title">Page not found</div>
    <a href="{{url('/')}}" class="btn btn-rounded">Main page</a>
</div>