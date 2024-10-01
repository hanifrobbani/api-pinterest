<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::where('user', Auth::user()->username)->latest()->get();
        return  view('post.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:99', 'min:5'],
            'image' => ['nullable', 'image', 'file', 'max:5024'],
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $newFileName = time() . '-' . $file->getClientOriginalName();
            $newFilePath = $file->storeAs('img-store', $newFileName, 'public');
            $validatedData['image'] = $newFilePath;
        }

        try {
            if (Auth::check()) {
                $validatedData['user'] = Auth::user()->username;

                Post::create($validatedData);
                return redirect('/posts')->with('success', 'Data berhasil ditambahkan!');
            }
        } catch (\Exception $e) {
            return redirect('/posts/create')->with('error', 'Terjadi masalah' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Post::findOrFail($id);
        return view('post.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:50', 'min:2'],
            'image' => ['image', 'file', 'max:5024'],
        ]);

        $data = Post::findOrFail($id);

        // Jika ada file baru yang di-upload
        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }

            $file = $request->file('image');
            $newFileName = time() . '-' . $file->getClientOriginalName();
            $newFilePath = $file->storeAs('img-store', $newFileName, 'public');
            $validatedData['image'] = $newFilePath;
        } else {
            $validatedData['image'] = $data->image;
        }

        try {
            $data->update($validatedData);
            return redirect("/posts")->with('success', 'Data berhasil diubah!'); 
        } catch (\Exception $e) {
            return redirect("/posts")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Post::findOrFail($id);

        $data->delete();

        return redirect('/posts')->with('success', 'Data Berhasil Dihapus!');
    }
}
