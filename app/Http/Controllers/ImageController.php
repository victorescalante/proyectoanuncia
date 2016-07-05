<?php

namespace Anuncia\Http\Controllers;

use Anuncia\Image;
use Illuminate\Http\Request;

use Anuncia\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Hola";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store($files,$footbridge)
    {
        $order=1;
        foreach ($files as $file) {
            $name = $this->reName($file->getClientOriginalName());
            Storage::disk('footbridges')->put($name,File::get($file));
            $image = new Image();
            $image->name          = $name;
            $image->order         = $order;
            $image->url           = url('images/footbridges/'.$name);
            $image->footbridge_id = $footbridge->id;
            $image->save();
            $order++;

        }
        return;
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        Storage::disk('footbridges')->delete($item->name);
        Image::destroy($item->id);
    }


    public function reName($name){

        $count=1;
        while(file_exists(public_path('images/footbridges/'.$name))){
            $name = $count.$name;
            $count++;
        }
        return $name;
    }
}
