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
  <h1>Todo List</h1>
  <a href="<?php echo URL::to('todo/add'); ?>" class="btn btn-success">Add</a><br/>
  <ul class="list-group">
    <?php if($entries){ ?>
      <?php foreach($entries as $entry){ ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?php echo $entry->title; ?>
          <div class="align-items-right">
            <a href="<?php echo URL::to('todo/edit/'.$entry->id); ?>" class="btn btn-primary">Edit</a>
            <a href="<?php echo URL::to('todo/delete/'.$entry->id); ?>" class="btn btn-danger">Remove</a>
        </div>
        </li>
      <?php } ?>
    <?php } ?>
  </ul>
</div>