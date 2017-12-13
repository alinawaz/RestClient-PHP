<?php use RestClient\Libs\Lang; use RestClient\Libs\URL; ?><?php  $language="english";  ?> <html>
  <head>
    <title>Welcome</title>
    <link href="http://localhost/restclient/Assets/bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
    <div class="jumbotron rtl">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a href="<?php echo URL::to('switch_language/english'); ?>" class="btn <?php echo ($language=='english'?'btn-primary':'btn-default'); ?>">English</a>
        <a href="<?php echo URL::to('switch_language/urdu'); ?>" class="btn <?php echo ($language=='urdu'?'btn-primary':'btn-default'); ?>">اردو</a>
      </div>
      <h1 class="display-3"><?php echo Lang::get('basic.title'); ?></h1>
      <hr class="my-4">
      <p><?php echo Lang::get('basic.description'); ?></p>
    </div>
  </body>
</html>