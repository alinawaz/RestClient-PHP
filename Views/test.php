<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		@include(header)
		<h1>Welcome {{$name}}</h1>

		<ul>
		@for($i=1;$i<=$count;$i++)
			@if($i!=5)
				<li>{{$i}}</li>
			@endif
		@endfor
		</ul>

	</body>
</html>