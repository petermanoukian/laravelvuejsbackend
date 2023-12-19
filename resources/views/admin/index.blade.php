<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="author" content="Simon Kibaru">
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:8000/api');
header('Access-Control-Allow-Origin: http://127.0.0.1:8000/api/');
header("Access-Control-Allow-Origin: http://127.0.0.1"); 
header("Access-Control-Allow-Origin: http://127.0.0.1:8000"); 

?>


<title>Admin</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/css.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
 <main-App />
</div>


<script src="{{ asset('js/app.js') }}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>


</body>
</html>