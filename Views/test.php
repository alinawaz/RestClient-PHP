<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		@include(header)
		<h1>Welcome {{$name}}</h1>

		<ul>
		@for($i=1;$i<=$count;$i++)
			<li>{{$i}}</li>
		@endfor
		</ul>

	</body>
</html>