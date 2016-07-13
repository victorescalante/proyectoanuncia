<?php

namespace Anuncia\Http\Controllers;

use Anuncia\Http\Requests\addPhotoRequest;
use Anuncia\updatePhotoToFootbridge;
use Anuncia\addPhotoToFootbridge;
use Illuminate\Http\Request;
use Anuncia\Http\Requests;
use Anuncia\Footbridge;
use Anuncia\Photo;



class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }



    public function store(addPhotoRequest $request)
    {

        $id = $request->get('id_footbridge');
        
        $footbridge = Footbridge::findOrFail($id);

        $file = $request->file('Photo');

        try{

            (new addPhotoToFootbridge($footbridge,$file))->save();

        }catch (\Exception $e){

            var_dump("Error adding Photo at Footbridge");

        }


        $photo_last = Photo::all()->last();

        return response()->json($photo_last);

    }

    public function update(addPhotoRequest $request)

    {


        $id = $request->get('id'); // This ID is the image

        $file = $request->file('Photo'); // This a new file

        $photo = Photo::findOrFail($id);

        try{

            (new updatePhototoFootbridge($photo,$file))->save();
            
        }catch (\Exception $e){

            var_dump("Error updating Photo at Footbridge");

        }



        return response()->json(['update' => 'Ok']);


    }


    public function destroy(Request $request){

        $id = $request->get('id');

        Photo::findOrFail($id)->delete();

        return response()->json(['delete' => 'Ok']);

    }



}
