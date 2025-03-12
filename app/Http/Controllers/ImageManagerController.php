<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageManagerController extends Controller
{
    public function index()
    {
        $images = Storage::disk('public')->files();
        return view('admin.images-manager.index', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate(['images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $newName = time() . $key . '.' . $image->getClientOriginalExtension();
                $image->storeAs('', $newName, 'public');
            }
        }
        return redirect()->route('image.manager')->with('success', 'Berhasil mengunggah gambar.');
    }
    public function delete(Request $request)
    {
        $path = $request->input('path');
        $post = Post::where('content', 'LIKE', '%' . $path . '%')->first();
        if ($post) {
            return redirect()->route('image.manager')->with('error', 'Gambar sedang digunakan dalam post dan tidak bisa dihapus.');
        }
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        return redirect()->route('image.manager')->with('success', 'Berhasil menghapus gambar.');
    }
}