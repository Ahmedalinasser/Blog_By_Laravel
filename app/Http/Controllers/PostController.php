<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index(){
       
        $posts = Post::all();
        // $posts = auth()->user()->posts()->paginate(2);
        // $posts = auth()->user()->posts;

        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function show(Post $post){
       
        return view('post.blog_post', ['post'=>$post]);
    }


    public function create(){
       
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store (){
        $this->authorize('create', Post::class);
      $inputs =  request()->validate([
                'title'=>'required|min:8|max:255 ',
                'post_image'=>'file', // 'mimems:jpeg,bmp,png' for images types
                'content'=>'required'
        ]);

        if (request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        
        auth()->user()->posts()->create($inputs);
        Session::flash('post-created-message' , 'Post was created ');
        return redirect()->route('post.index');   
    }

    public function destroy(Post $post, Request $request){

        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('message' , 'Post was deleted');
        return back(); 

    } 

    public function edit(Post $post) {
        $this->authorize( 'view', $post);
        // if(auth()->user()->can('view', $post)){
        //     return view('admin.posts.edit', ['post'=>$post]);
        // }

        return view('admin.posts.edit', ['post'=>$post]);
    }
        
    public function update(Post $post) {

        $inputs =  request()->validate([

            'title'=>'required|min:8|max:255 ',
            'post_image'=>'file', // 'mimems:jpeg,bmp,png' for images types
            'content'=>'required'
    ]);
    
    if (request('post_image')){
        $inputs['post_image'] = request('post_image')->store('images');
        $post->post_image = $inputs['post_image'];
    }

    $post->title = $inputs ['title'];
    $post->content = $inputs ['content'];
    $this->authorize('update', $post);
    // auth()->user()->posts()->save($post);
    $post->update();
    session()->flash('post-updated-message', 'Post was Updated  ');
    // Session::flash('post-updated-message' , 'Post was updated ');
    return redirect()->route('post.index');

    }

}
