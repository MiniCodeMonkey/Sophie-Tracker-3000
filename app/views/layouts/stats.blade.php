<!DOCTYPE html>
<html>
<head>
    <title>Sophie Tracker 3000</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
<link href="/css/jquery.gridster.min.css" rel="stylesheet">
    {{ stylesheet('stats.css') }}

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-152x152.png" />
</head>
<body id="stats">
@yield('content')

@section('scripts')
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="/js/jquery.gridster.min.js"></script>
	{{ script() }}
@show
</body>
</html>