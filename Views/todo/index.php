@include(todo/header)
<div class="container">
  <h1>Todo List</h1>
  <a href="{{URL::to('todo/add')}}" class="btn btn-success">Add</a><br/>
  <ul class="list-group">
    @if($entries)
      @foreach($entries as $entry)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$entry->title}}
          <div class="align-items-right">
            <a href="{{URL::to('todo/edit/'.$entry->id)}}" class="btn btn-primary">Edit</a>
            <a href="{{URL::to('todo/delete/'.$entry->id)}}" class="btn btn-danger">Remove</a>
        </div>
        </li>
      @endforeach
    @endif
  </ul>
</div>