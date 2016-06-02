<?php

namespace Anuncia\Http\Controllers;

use Anuncia\Footbridge;
use Anuncia\Image;
use Anuncia\Municipality;
use Anuncia\State;
use Illuminate\Http\Request;
use Anuncia\Http\Requests;
use Illuminate\Support\Facades\DB;
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

        // $footbridges = Footbridge::paginate(10);
        // $footbridges->load('municipality');

        $footbridges = Footbridge::with('municipality')->paginate(10);

        return view('footbridge.home')->with(['footbridges' => $footbridges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('footbridge.create')->with([
            'states' => $states,
        ]);
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
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('footbridge_create_path')
                ->withErrors($validator)
                ->withInput();
        }


        $footbridge = new Footbridge();
        $footbridge->name            = $request->get('name');
        $footbridge->availability    = $request->get('availability');
        $footbridge->description     = $request->get('description');
        $footbridge->position        = $request->get('position');
        $footbridge->views           = $request->get('views');
        $footbridge->frontal         = $request->get('frontal');
        $footbridge->crusade         = $request->get('crusade');
        $footbridge->mega            = $request->get('mega');
        $footbridge->side            = $request->get('side');
        $footbridge->street          = $request->get('street');
        $footbridge->reference_c     = $request->get('reference_c');
        $footbridge->reference_n     = $request->get('reference_n');
        $footbridge->reference_s     = $request->get('reference_s');
        $footbridge->reference_o     = $request->get('reference_o');
        $footbridge->reference_p     = $request->get('reference_p');
        $footbridge->municipality_id = $request->get('municipality_id');
        $footbridge->order           = $request->get('order');
        $footbridge->latitude        = $request->get('latitude');
        $footbridge->length          = $request->get('length');
        $footbridge->save();


        $files_images = $request->file('url');

        if( $files_images[0] != NULL ){
            $files     = $request->file('url');
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
        return view('footbridge.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footbridge = Footbridge::findOrFail($id);
        $states = State::all();
        $municipalities = DB::table('municipalities')->where('state_id','=',$footbridge->municipality->state->id)->get();
        //dd($municipalities);
        return view('footbridge.edit', [
            'footbridge' => $footbridge,
            'states'     => $states,
            'municipalities' => $municipalities,
        ]);



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

        $footbridge = Footbridge::findOrFail($id);
        $footbridge->name            = $request->get('name');
        $footbridge->availability    = $request->get('availability');
        $footbridge->description     = $request->get('description');
        $footbridge->position        = $request->get('position');
        $footbridge->views           = $request->get('views');
        $footbridge->frontal         = $request->get('frontal');
        $footbridge->crusade         = $request->get('crusade');
        $footbridge->mega            = $request->get('mega');
        $footbridge->side            = $request->get('side');
        $footbridge->street          = $request->get('street');
        $footbridge->reference_c     = $request->get('reference_c');
        $footbridge->reference_n     = $request->get('reference_n');
        $footbridge->reference_s     = $request->get('reference_s');
        $footbridge->reference_o     = $request->get('reference_o');
        $footbridge->reference_p     = $request->get('reference_p');
        $footbridge->municipality_id = $request->get('municipality_id');
        $footbridge->order           = $request->get('order');
        $footbridge->latitude        = $request->get('latitude');
        $footbridge->length          = $request->get('length');
        $footbridge->save();

        return redirect($request->get('url_home_catalog'));
    }
    
    
    public function question_destroy($id)
    {
        $footbridge = Footbridge::findOrFail($id);
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
        $footbridge = Footbridge::findOrFail($id);
        $footbridge_images = Footbridge::findOrFail($id)->images;
        foreach($footbridge_images as $footbridge_image){
            $name = $footbridge_image->name;
            Storage::disk('footbridges')->delete($name);
            $footbridge_image->delete();
        }
        $footbridge->delete();

        return redirect()->route('footbridge_home_path');

    }
    

    public function select(Request $request){

        $id = $request->get('id');
        $state = State::find($id);
        $municipalities = $state->municipalities;
        return view('footbridge.select')->with([
            'municipalities' => $municipalities,
        ]);
    }
}
