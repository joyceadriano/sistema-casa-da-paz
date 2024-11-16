<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $imagesByType = Image::all()->groupBy('type');
        return view('admin.admin', compact('imagesByType'));
    }

    public function create()
    {
        return view('admin.images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Image::create([
            'type' => $request->type,
            'path' => $path,
        ]);

        return redirect()->route('admin.images.index')->with('success', 'Imagem adicionada com sucesso!');
    }




    public function edit($id)
{
    $image = Image::findOrFail($id);
    return view('admin.images.edit', compact('image'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $image = Image::findOrFail($id);
    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($image->path);

        $path = $request->file('image')->store('images', 'public');
        $image->path = $path;
    }

    $image->type = $request->type;
    $image->save();

    return redirect()->route('admin.images.index')->with('success', 'Imagem atualizada com sucesso!');
}

public function destroy($id)
{
    $image = Image::findOrFail($id);
    Storage::disk('public')->delete($image->path);
    $image->delete();

    return redirect()->route('admin.images.index')->with('success', 'Imagem excluída com sucesso!');
}

public function getAllImages()
{
    $images = Image::all();
    return response()->json($images);
}

}
