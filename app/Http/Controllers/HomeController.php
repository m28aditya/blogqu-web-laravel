<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function index() {
        FacadesSession::forget('filter');
        $data = Post::with(['user'])->latest()->get();
        
        return view('pages.index',[
            'data' => $data,
        ]);
    }
    
    public function author($author) {
        $author = User::where('name',$author)->first();
        $data = Post::where('user_id',$author->id)->latest()->get();
        
        session()->flash('filter', $author->name);

        return view('pages.index',[
            'data' => $data,
        ]);
    }

    public function search() {
        $data = POST::latest()
            ->where('title','like','%'.request('search').'%')
            ->orWhere('content','like','%'.request('search').'%')->get();
            
            session()->flash('filter', request('search'));
            
            return view('pages.index',[
            'data' => $data,
            ]);
        }
    
    public function post($slug) {
        $data = Post::where('slug',$slug)->first();
        $comments = Comment::where('post_id',$data->id)->get();
        $liked = true;
        if(Auth::check()) {
            $liked = Like::where([
                ['user_id','=',Auth::user()->id],
                ['post_id','=',$data->id]
                ])->get()->isEmpty();
        }

        return view('pages.post',[
            'comments' => $comments,
            'data' => $data,
            'liked' => $liked
        ]);
    }
    
    public function like($slug) {
        $post = Post::where('slug',$slug)->first();
        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $post->id;
        Like::create($data);
        return redirect()->back();
    }
    
    public function unlike($slug) {
        $data = Post::where('slug',$slug)->first();
        $liked = Like::where([
            ['user_id','=',Auth::user()->id],
            ['post_id','=',$data->id]
            ])->first();
        $liked->delete();
        return redirect()->back();
    }

    public function comment(Request $request, $slug) {
        $post = Post::where('slug',$slug)->first();
        $validatedData = $request->validate([
            'comment' => 'max:100',
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['post_id'] = $post->id;
        Comment::create($validatedData);
        return redirect()->back();
    }
}