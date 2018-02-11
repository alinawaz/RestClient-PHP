<?php use System\Libs\Lang; use System\Libs\URL; ?><html>
  <head>
    <title>Welcome</title>
    <link href="http://restclient-php.test/public/css/bootstrap.css" rel="stylesheet"/>
    <script src="http://restclient-php.test/public/js/jquery.js" type="text/javascript"></script>
    <script src="http://restclient-php.test/public/js/popper.js" type="text/javascript"></script>
    <script src="http://restclient-php.test/public/js/bootstrap.js" type="text/javascript"></script>
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