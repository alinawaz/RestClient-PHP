<html>
  <head>
    <title>Welcome</title>
    <link href="~bootstrap.css" rel="stylesheet"/>
    <script src="~jquery.js" type="text/javascript"></script>
    <script src="~popper.js" type="text/javascript"></script>
    <script src="~bootstrap.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="jumbotron">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a href="{{URL::to('switch_language/english')}}" class="btn {{($language=='english'?'btn-primary':'btn-light')}}">English</a>
        <a href="{{URL::to('switch_language/urdu')}}" class="btn {{($language=='urdu'?'btn-primary':'btn-light')}}">اردو</a>
      </div>
      <h1 class="display-3">{{Lang::get('basic.title')}}</h1>
      <hr class="my-4">
      <p>{{Lang::get('basic.description')}}</p>
      <p class="lead">
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Lang::get('basic.get_started')}}
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">{{Lang::get('basic.download')}}</a>
            <a class="dropdown-item" href="#">{{Lang::get('basic.introduction')}}</a>
            <a class="dropdown-item" href="#">{{Lang::get('basic.documentation')}}</a>
          </div>
        </div>
      </p>
    </div>
  </body>
</html>