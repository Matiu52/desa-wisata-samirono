<?php

namespace App\Services;

use DOMDocument;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostService
{
    public function processData(array $data, ?Post $post = null): array
    {
        $content = $data['content'] ?? '';
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'base64,') !== false) {
                $base64String = explode(',', explode(';', $src)[1])[1];
                $decoded = base64_decode($base64String);
                $mimeType = explode(';', explode(':', $src)[1])[0];
                $ext = explode('/', $mimeType)[1];
                $fileName = "/images/uploads/" . time() . $key . '.' . $ext;
                file_put_contents(public_path($fileName), $decoded);
                $img->setAttribute('src', $fileName);
            }
        }

        $data['content'] = $dom->saveHTML();

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists() && (!$post || $post->slug !== $slug)) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data['slug'] = $slug;
        $data['user_id'] = Auth::id();

        return $data;
    }

    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword', ''));
        $posts = Post::with('comments');

        if ($keyword) {
            $posts = $posts->where('title', 'like', "%$keyword%")
                ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$keyword%"));
        }

        $posts = $posts->orderByDesc('created_at')->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('admin.posts.components.table-post', compact('posts'))->render());
        }

        return view('admin.posts.index', compact('posts', 'keyword'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $this->processData($request->validated());
        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function show(Post $post)
    {
        $post = Post::with(['comments.user'])
            ->where('slug', $post->slug)
            ->firstOrFail();

        return view('admin.posts.show', [
            'post' => $post,
            'userName' => $post->user->name,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $this->processData($request->validated(), $post);
        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupdate.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

    public function list()
    {
        $files = array_filter(glob(public_path('images/uploads/*')), 'is_file');
        return response()->json(array_map('basename', $files));
    }
}