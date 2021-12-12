@extends('layouts.admin')

@section('content')

    <h1>Edit Post</h1>

    <form method="POST" action="{{route('post.update', $post->id)}}"  enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    


    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
                name="title" 
                id="" 
                placeholder="Enter Title"  
                class="form-control"
                value="{{$post->title}}">
    </div>
    <div class="form-group">
        <label for="file">File</label>
        <div><img src="{{$post->post_image}}" alt="" height="150" width="280"></div>
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
                  rows="10">{{$post->content}}</textarea>
    </div>
    <button type="submit"  class="btn btn-primary">Submit</button>
    </form>
    
<!-- emmet -->

@endsection 
