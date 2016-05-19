<?php

namespace Anuncia\Http\Controllers;

use Anuncia\Footbridges;
use Anuncia\Image;
use Illuminate\Http\Request;
use Anuncia\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FootbridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $footbridges = Footbridges::all();
        return view('footbridge.home')->with(['footbridges' => $footbridges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('footbridge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         =>  'required',
            'availability' =>  'required',
            'url'          =>  'mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('footbridge_create_path')
                ->withErrors($validator)
                ->withInput();
        }

        $footbridge = new Footbridges();
        $footbridge->name = $request->get('name');
        $footbridge->availability = $request->get('availability');
        $footbridge->description = $request->get('description');
        $footbridge->order = $request->get('order');
        $footbridge->latitude = $request->get('latitude');
        $footbridge->length = $request->get('length');
        $footbridge->save();

        //Upload file img - if exists value in request
        if(!empty($request->file('url'))){
            $file = $request->file('url');
            $name = $file->getClientOriginalName();
            $i=1;
            while(file_exists(storage_path('app/footbridges/'.$name))){
                $name= $i.$name; $i++;
            }
            Storage::disk('footbridges')->put($name,File::get($file));
            $image = new Image();
            $image->name = $name;
            $image->url = $name;
            $image->footbridge_id = $footbridge->id;
            $image->save();
        }


        return redirect()->route('footbridge_home_path');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footbridge = Footbridges::findOrFail($id);
        return view('footbridge.edit', ['footbridge' => $footbridge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $footbridge = Footbridges::findOrFail($id);
        $footbridge->name = $request->get('name');
        $footbridge->availability = $request->get('availability');
        $footbridge->description = $request->get('description');
        $footbridge->order = $request->get('order');
        $footbridge->latitude = $request->get('latitude');
        $footbridge->length = $request->get('length');
        $footbridge->save();

        return redirect()->route('footbridge_home_path');
    }
    
    
    public function question_destroy($id)
    {
        $footbridge = Footbridges::findOrFail($id);
        return view('footbridge.delete',['footbridge' => $footbridge]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $footbridge = Footbridges::findOrFail($id);
        $footbridge_images = Footbridges::findOrFail($id)->images;
        foreach($footbridge_images as $footbridge_image){
            $name = $footbridge_image->name;
            Storage::disk('footbridges')->delete($name);
        }
        $footbridge->delete();

        return redirect()->route('footbridge_home_path');

    }
}
