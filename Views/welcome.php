<html>
  <head>
    <title>Welcome</title>
    <link href="~bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
    <div class="jumbotron">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a href="{{URL::to('switch_language/english')}}" class="btn {{($language=='english'?'btn-primary':'btn-default')}}">English</a>
        <a href="{{URL::to('switch_language/urdu')}}" class="btn {{($language=='urdu'?'btn-primary':'btn-default')}}">اردو</a>
      </div>
      <h1 class="display-3">{{Lang::get('basic.title')}}</h1>
      <hr class="my-4">
      <p>{{Lang::get('basic.description')}}</p>
    </div>
  </body>
</html>