<?php

namespace Anuncia\Http\Controllers;

use Illuminate\Http\Request;

use Anuncia\Http\Requests;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return "Hola";
        dd($request->all());
        var_dump($files);
        var_dump($footbridge);

        $order_img = 1;
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $count_number_imgs = 1;
            while(file_exists(storage_path('app/footbridges/'.$name))){
                $name= $count_number_imgs.$name; $count_number_imgs++;
            }

            Storage::disk('footbridges')->put($name,File::get($file));
            $image = new Image();
            $image->name          = $name;
            $image->order         = $order_img;
            $image->url           = $name;
            $image->footbridge_id = $footbridge->id;
            $image->save();
            $order_img++;
        }
        return;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
