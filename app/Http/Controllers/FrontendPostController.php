<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FrontendPostController extends Controller
{

    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $keyword = strtolower($request->get('keyword', ''));
        $postsQuery = Post::query();
        if ($keyword) {
            $postsQuery = $postsQuery->where('title', 'LIKE', '%' . $keyword . '%')->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }
        $posts = $postsQuery->orderBy('created_at', 'desc')->paginate(12);
        foreach ($posts as $post) {
            $post->image = $this->extractFirstImage($post->content) ?? asset('images/default-image-post.png');
        }
        $carousels = Carousel::all();
        if ($request->ajax()) {
            return response()->json(view('frontend.posts.components.posts', compact('posts'))->render());
        }
        return view('posts', compact('posts', 'keyword', 'carousels'));
    }

    private function extractFirstImage($content)
    {
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);

        return $image['src'] ?? null;
    }

    public function show(Post $post)
    {
        Carbon::setLocale('id');
        return view('frontend.posts.show', compact('post'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

}