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


<title>Visit Armenia  </title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Safario Travel - Home</title>


  <link rel="stylesheet" href="{{ asset('confer/style.css') }} ">
  <link href="{{ asset('css/css.css') }}" rel="stylesheet">


</head>
<body  class="bg-shape">
  <div id="fb-root"></div>
 

<div id="app2">
 <main-Home />
</div>
<script src="{{ asset('js/app2.js') }}"></script>





<script src="{{ asset('confer/js/jquery.min.js') }}"></script>
<script src="{{ asset('confer/js/popper.min.js') }}"></script>
<script src="{{ asset('confer/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('confer/js/confer.bundle.js') }}"></script>
<script src="{{ asset('confer/js/default-assets/active.js') }}"></script>


 <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk')); 
$(document).ready(function () 
{  
	$('.page-link').click(function()
	{
		alert(1);
	
	});
	$('.page-item').click(function()
	{
		alert(2);
	
	});
});	
</script>
</body>
</html>