<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class DashboardController extends Controller
{
    public function index() {
        $data = Post::where('user_id',Auth::user()->id)->get();
        
        return view('pages.dashboard.index', [
            'data' => $data
        ]);
    }
    public function create() {
        return view('pages.dashboard.create');
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
        ]);
        $validatedData['image'] = $validatedData['image']->store('post_image');
        $validatedData['user_id'] = Auth::user()->id;
        Post::create($validatedData);
        return redirect('/dashboard')->with('success','Artikel Berhasil Dibuat');
    }
    public function edit($id) {
        $data = Post::where('id',$id)->first();

        return view('pages.dashboard.detail',[
            'data' => $data
        ]);
    }
    public function update(Request $request, $id) {
        $update = Post::where('id',$id)->first();
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image',
            'content' => 'required'
        ]);

        if($request->image){
            Storage::delete([$request->oldImage]);
            $validatedData['image'] = $validatedData['image']->store('post_image');   
        }
        $update->update([
            'title' => $validatedData['title'],
            'image' => $validatedData['image'],
            'content' => $validatedData['content']]);
        
        return redirect('/dashboard')->with('success','Artikel Berhasil diperbaharui');
    }
    public function destroy($id) {
        $data = Post::where('id',$id)->first();
        if($data->image){
            Storage::delete([$data->image]);
        }
        
        Like::where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        $data->delete();
        return redirect('/dashboard')->with('success','Artikel Berhasil dihapus');
    }
}