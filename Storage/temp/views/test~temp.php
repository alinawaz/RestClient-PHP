<?php  $name="Ali";  $count=12;  ?> <html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<div style="width: 100%; height: auto; padding-top: 5px;padding-bottom: 5px; background-color: grey;">
	<ul>
	<li>Home</li>
	<li>About</li>
	<li>Logged In User: <?php echo $name; ?></li>
	<li>Count: <?php echo $count; ?></li>
</ul>
</div>
		<h1>Welcome <?php echo $name; ?></h1>

		<ul>
		<?php for($i=1;$i<=$count;$i++){ ?>
			<?php if($i!=5){ ?>
				<li><?php echo $i; ?></li>
			<?php } ?>
		<?php } ?>
		</ul>

	</body>
</html>