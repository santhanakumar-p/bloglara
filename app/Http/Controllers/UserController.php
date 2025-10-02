<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showFullPost(int $id)
    {
        $post = Post::findOrFail($id);

        return view('fullpost', compact('post'));
    }

    public function showDataInHome()
    {
        $posts = Post::all();

        return view('home', compact('posts'));
    }

    public function home(Request $request)
    {
        if ($request->user()->usertype == 'user') {
            return view('dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function index(Request $request)
    {
        if ($request->user()->usertype == 'admin') {
            return view('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
