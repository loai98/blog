<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller {

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //   return DB::select("select * from posts");
        //     return Post::orderBy("created_at","desc")->take(2)->get();
        // return Post::orderBy("created_at","desc")->paginate(1)
        $data = [
            'title' => "Posts",
            'posts' => Post::orderBy("created_at", "desc")->get(),
        ];
        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("posts.create")->with('title', "Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'image'=>'image|nullable'
        ]);
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id= auth()->user()->id;

        if($request->hasFile('image')){
            $imageNameWithExtintion =  $request->file('image'); 
            $imageName= pathinfo($imageNameWithExtintion->getClientOriginalName(), PATHINFO_FILENAME);
            $imageExtintion=$imageNameWithExtintion->getClientOriginalExtension();
            $fileNameToSave = $imageName.Time().'.'.$imageExtintion;
            $post->image = $fileNameToSave;
            $request->file('image')->storeAs('public/images',$fileNameToSave);
       }


        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::find($id);
        if ($post) {
            $content = [
                'user_id'=>$post->user_id,
                'title' => $post->title,
                'post' => $post,
            ];
            return view("posts.show")->with($content);
        }
        return "Not found";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
       
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts/'.$post->id)->with('error','Access denied');
        }
        $content =[
            'title'=>'Edit ',
            'post'=>$post
        ];
        return view('posts.edit')->with($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image')){
            $fileNameWithExtintion = $request->file('image');
            $imageName = pathinfo($fileNameWithExtintion,PATHINFO_FILENAME); 
            $imageExtintion = $fileNameWithExtintion->getClientOriginalExtension();
            $fileNameToSave = $imageName. time() .'.'.$imageExtintion;
            $request->file('image')->storeAs('public/images',$fileNameToSave); 
            Storage::delete('public/images/'.$post->image);
            $post->image = $fileNameToSave;
        }
        $post->save();
        return redirect('posts/'.$id)->with('success',"Post updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts/'.$id)->with('error','Access denied');
        }
        if($post->image){
            Storage::delete('public/images/'.$post->image);
        }
        $post->delete();

       return redirect('/posts')->with('delete', "Post Deleted");
    }
}
