<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		@include(header)
		<h1>Welcome {{$name}}</h1>
		@if($count==1)
			<p>Count is One: {{$count}}</p>
		@endif
	</body>
</html>