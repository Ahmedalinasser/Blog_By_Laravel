@extends('layouts.admin')

@section('content')

    <h1>create</h1>

    <form method="POST" action="{{route('post.store')}}"  enctype="multipart/form-data">
    
    @csrf
  


    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
                name="title" 
                id="" 
                placeholder="Enter Title"  
                class="form-control">
    </div>
    <div class="form-group">
        <label for="file">File</label>
        <input type="file" 
                name="post_image" 
                id="" 
                class="form-control-file">
    </div>
    <div class="form-group">
        <div><label for="content">Body of the Content</label></div>
        <textarea name="content" 
                  id="" 
                  class="form_control" 
                  cols="100"
                  rows="10"></textarea>
    </div>
    <button type="submit"  class="btn btn-primary">Submit</button>
    </form>
    
<!-- emmet -->

@endsection 
