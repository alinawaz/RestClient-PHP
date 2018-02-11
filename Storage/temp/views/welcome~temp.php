<?php use System\Libs\Lang; use System\Libs\URL; ?><html>
  <head>
    <title>Welcome</title>
    <link href="http://restclient-php.test/public/css/bootstrap.css" rel="stylesheet"/>
    <script src="http://restclient-php.test/public/js/jquery.js" type="text/javascript"></script>
    <script src="http://restclient-php.test/public/js/popper.js" type="text/javascript"></script>
    <script src="http://restclient-php.test/public/js/bootstrap.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="jumbotron">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a href="<?php echo URL::to('switch_language/english'); ?>" class="btn <?php echo ($language=='english'?'btn-primary':'btn-light'); ?>">English</a>
        <a href="<?php echo URL::to('switch_language/urdu'); ?>" class="btn <?php echo ($language=='urdu'?'btn-primary':'btn-light'); ?>">اردو</a>
      </div>
      <h1 class="display-3"><?php echo Lang::get('basic.title'); ?></h1>
      <hr class="my-4">
      <p><?php echo Lang::get('basic.description'); ?></p>
      <p class="lead">
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo Lang::get('basic.get_started'); ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"><?php echo Lang::get('basic.download'); ?></a>
            <a class="dropdown-item" href="#"><?php echo Lang::get('basic.introduction'); ?></a>
            <a class="dropdown-item" href="#"><?php echo Lang::get('basic.documentation'); ?></a>
          </div>
        </div>
      </p>
      <a href="<?php echo URL::to('todo'); ?>" class="btn btn-primary">TODO Example</a>
    </div>
  </body>
</html>