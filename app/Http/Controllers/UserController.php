<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    private function extractFirstImage($content)
    {
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);

        return $image['src'] ?? null;
    }
    public function show($name)
    {
        $name = urldecode($name);
        $user = User::where('name', $name)->firstOrFail();
        $posts = $user->posts()->latest()->paginate(12);
        foreach ($posts as $post) {
            $post->image = $this->extractFirstImage($post->content) ?? asset('images/default-image-post.png');
        }

        return view('frontend.posts.showByAuthor', compact('user', 'posts'));
    }

}