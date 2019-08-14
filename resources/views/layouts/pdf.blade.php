<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ asset('project.ico') }}">
  <title>RAB Apps</title>
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style type="text/css">
    td{
      color: black;
      font-family: monospace;
      font-size: 13px;
    }
    th{
      color: black;
      font-family: monospace;
      font-size: 13px;
    }
    .table td, .table th{
      padding: 5px;
    }
    h1{
      font-size: 100px;
    }
    footer { 
      position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px;
      color: black;
      font-family: monospace;
      font-size: 13px; 
    }
  </style>
</head>

<body id="page-top">
  @yield('content')
</body>

</html>
