<?php use RestClient\Libs\Lang; use RestClient\Libs\URL; ?><html>
  <head>
    <title>Welcome</title>
    <link href="http://localhost/restclient/Assets/bootstrap.css" rel="stylesheet"/>
    <script src="http://localhost/restclient/Assets/jquery.js" type="text/javascript"></script>
    <script src="http://localhost/restclient/Assets/popper.js" type="text/javascript"></script>
    <script src="http://localhost/restclient/Assets/bootstrap.js" type="text/javascript"></script>
  </head>
  <body>
<div class="container">
  <form method="POST" action="<?php echo URL::to('todo/update'); ?>">
  	<input type="hidden" name="id" value="<?php echo $entry->id; ?>"/>
    <h2>Edit Todo</h2>
    <div class="form-group">
      <label>Title</label>
      <input type="text" value="<?php echo $entry->title; ?>" name="title" class="form-control" placeholder="Todo Title">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>