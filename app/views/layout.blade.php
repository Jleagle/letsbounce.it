<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>

	<title>Bootstrap 101 Template</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


	{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
	{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'); }}
	@section('css')
	@show

</head>
<body>

	<div class="container">
		@yield('content')
	</div>

  {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
  {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'); }}
  {{ HTML::script('js/main.js'); }}

	@section('js')
	@show

</body>
</html>
