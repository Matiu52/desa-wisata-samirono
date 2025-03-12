<?php

namespace App\Http\Controllers;


use DOMDocument;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class PostController extends Controller
{

    protected function processData(Request $request, $post = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);
        $content = $request->content;
        $dom = new DOMDocument();
        $dom->loadHTML($content, 9);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'base64,') !== false) {
                $base64String = explode(',', explode(';', $src)[1])[1];
                $data = base64_decode($base64String);
                $mimeType = explode(';', explode(':', $src)[1])[0];
                $ext = explode('/', $mimeType)[1];
                $image_name = "/images/uploads/" . time() . $key . '.' . $ext;
                file_put_contents(public_path() . $image_name, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        $content = $dom->saveHTML();
        $data = $request->except(['content']);
        $data['content'] = $content;
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists() && ($post ? $post->slug !== $slug : true)) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;
        $data['user_id'] = auth()->id();
        return $data;
    }

    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword', ''));
        $posts = Post::query();
        if ($keyword) {
            $posts = $posts->where('title', 'LIKE', '%' . $keyword . '%')->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }
        $posts = $posts->orderBy('created_at', 'desc')->paginate(10);
        if ($request->ajax()) {
            return response()->json(view('admin.posts.components.table-post', compact('posts'))->render());
        }
        return view('admin.posts.index', compact('posts', 'keyword'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $this->processData($request);
        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function show(Post $post)
    {
        $post = Post::where('slug', $post->slug)->firstOrFail();
        $userName = $post->user->name;
        return view('admin.posts.show', compact('post', 'userName'));

    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->processData($request, $post);
        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupdate.');
    }


    public function list()
    {
        $files = array_filter(glob(public_path('images/uploads/*')), 'is_file');

        $response = [];

        foreach ($files as $file) {
            $response[] = basename($file);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

}