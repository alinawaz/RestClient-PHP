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
  <form method="POST" action="<?php echo URL::to('todo/save'); ?>">
    <h2>Add New Todo</h2>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Todo Title">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>