<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
  //
  public function index()
  {
    $images = Image::all();

    return view('index', ['images' => $images]);

  }
  public function upload(Request $request)
  {
    if($request->hasFile('image')) {
        $title = $request->only('title');
        $image = $request->file('image');

        $name = $image->hashName();

        $return = $image->storePublicly('uploads', 'public', $name);
        $url = asset('storage/'.$return);

        Image::create([
            'title' => $title['title'],
            'url' => $url
        ]);
        return redirect()->route('index');

    }

  }
  public function delete($id)
  {
    //dd($id);
    $image = Image::findOrFail($id);
    //dd($image->url);
    $url = parse_url($image->url);
    //dd($url);
    $path = ltrim($url['path'], '/storage\/');
    //dd($path);
    if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
        $image->delete();
    }
    return redirect()->route('index');
  }
}
