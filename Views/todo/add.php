@include(todo/header)
<div class="container">
  <form method="POST" action="{{URL::to('todo/save')}}">
    <h2>Add New Todo</h2>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Todo Title">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>