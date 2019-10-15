<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        
        return view('setting.photos',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = auth()->user();
        $id = $current_user->id;
        // $image_name = $request->file('file')->getClientOriginalName();
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        
        $image_name = time()."_".rand(0,999999999)."_".md5(rand(0,9999999999999)).".".$fileExtension;
        $request->file->move(public_path('uploads/photos/'.$id), $image_name);
        $photo = Photo::firstOrCreate(['user_id'=>$id, 'image'=>$image_name, 'published_at'=>now()]);

        return response()->json(['uploaded' => '/uploads/photos/'.$id.'/'.$image_name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
