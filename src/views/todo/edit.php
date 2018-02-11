@include(todo/header)
<div class="container">
  <form method="POST" action="{{URL::to('todo/update')}}">
  	<input type="hidden" name="id" value="{{$entry->id}}"/>
    <h2>Edit Todo</h2>
    <div class="form-group">
      <label>Title</label>
      <input type="text" value="{{$entry->title}}" name="title" class="form-control" placeholder="Todo Title">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>