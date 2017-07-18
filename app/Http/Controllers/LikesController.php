<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Like;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function create($id)
    {
    	$post = Post::find($id);

    	$like = Like::create([
    		'user_id' => Auth::id(),
    		'post_id' => $post->id
    	]);

    	return Like::find($like->id);
    }

    public function destroy($id)
    {
    	$post = Post::find($id);

    	$like = Like::where('user_id', Auth::id())
    		->where('post_id', $post->id)
    		->first();

    	$like_id = $like->id;
    	
    	$like->delete();

    	return $like_id;
    }
}
