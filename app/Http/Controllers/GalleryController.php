<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
  //
  public function index()
  {
    return view('index');
  }
  public function upload(Request $request)
  {
    //$title = $request->only('title');
    //dd($title);

    //dd($request->hasFile('image'));
    if($request->hasFile('image')) {
        $image = $request->file('image');
        //$name = time() . '.' . rand(0,9999) . $image->getClientOriginalExtension();
        //$name = time() . '.' . rand(0,9999) . $image->getClientOriginalName();
        $name = $image->hashName();
        //dd($name);
        $return = $image->storePublicly('uploads', 'public', $name);
        dd($return);


        // $title = $request->input('title');
        // $url = $request->input('url');
    }
    //$image= $request->file('image');
    //dd($image);

  }
  public function delete()
  {
  }
}
