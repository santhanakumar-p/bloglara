<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function allpost()
    {
        $post = Post::all();

        return view('admin.allpost', compact('post'));
    }

    public function createpost()
    {
        return view('admin.createpost');
    }

    public function storepost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'content' => 'required|string',
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $firstImage = $request->file('image');
            $filename = time().'-'.$firstImage->getClientOriginalName();
            $firstImage->move(public_path('uploads'), $filename);
        }

        Post::create([
            'user_id' => Auth::User()->id,
            'user_name' => Auth::User()->name,
            'title' => $request->input('title'),
            'image' => $filename,
            'published_at' => $request->input('published_at'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('admin.allpost')
            ->with('success', 'Post created successfully!');
    }

    public function editpost(int $id)
    {
        $blog = Post::findOrFail($id);

        return view('admin.editpost', compact('blog'));
    }

    public function updatepost(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'content' => 'required|string',
        ]);

        $blog = Post::findOrFail($id);

        $filename = $blog->image;

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path('uploads/'.$blog->image))) {
                unlink(public_path('uploads/'.$blog->image));
            }

            $file = $request->file('image');
            $filename = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        }

        $blog->update([
            'user_id' => Auth::User()->id,
            'user_name' => Auth::User()->name,
            'title' => $request->input('title'),
            'image' => $filename,
            'published_at' => $request->input('published_at'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('admin.allpost')->with('success', 'Post updated successfully.');
    }

    public function destroypost(int $id)
    {
        $blog = Post::findOrFail($id);

        if ($blog->image && file_exists(public_path('uploads/'.$blog->image))) {
            unlink(public_path('uploads/'.$blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.allpost')->with('success', 'Post deleted successfully.');
    }
}
