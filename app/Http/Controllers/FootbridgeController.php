<?php

namespace Anuncia\Http\Controllers;

use Anuncia\Footbridge;
use Anuncia\Image;
use Anuncia\Municipality;
use Anuncia\State;
use Illuminate\Http\Request;
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



        if($request->hasFile('url')){

            $collection = collect($request->file('url'))
                ->reject(function ($file) {
                    return empty($file);
                });
            //send images at ControllerImage
            app(ImageController::class)->store($collection,$footbridge);

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
        $footbridge = Footbridge::findOrFail($id);
        $images = Image::ofFootbridge($footbridge);
        $footbridges_close = Footbridge::closeFootbridge($footbridge);
            
        return view('footbridge.show',[
            'footbridge' => $footbridge,
            'footbridges_close' => $footbridges_close,
            'images'     => $images,
        ]);
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
        $municipalities = Municipality::StateId($footbridge);
        $images = Image::ofFootbridge($footbridge);

        return view('footbridge.edit', [
            'footbridge' => $footbridge,
            'states'     => $states,
            'municipalities' => $municipalities,
            'images' => $images
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


        $band=1; //Esta es una variable para validar que haya imagenes en el dom

        if($request->hasFile('url') || $band==1){

            $files     = $request->file('url');
            $id        = $request->get('id');
            $tam_files = count($files);
            $order=1;

            $stringClear = collect($request->file('url'))
                ->reject(function ($file) {
                    return empty($file);
                });


            //Buscamos cuales estan en la base de datos y pedimos una coleccion
            $images_delete = DB::table('images')
                ->select('id','name')
                ->where('footbridge_id','=',$footbridge->id)
                ->whereNotIn('id',$id)
                ->get();


            if(!empty($images_delete)){

                foreach($images_delete as $item){

                }
            }

            for($i=0;$i<$tam_files;$i++){

                if( $files[$i] != null && $id[$i] != 'new') {
                    $valor_id = $id[$i];
                    $valor_file = $files[$i];
                    //var_dump($valor_id);
                    //var_dump($valor_file);
                    //Proceso de Actualización
                    $image = Image::findOrFail($valor_id);
                    var_dump($image);
                    if ($image) {
                        $anterior = $image->name;
                        //Guardo en el storage
                        $name = $valor_file->getClientOriginalName();
                        //var_dump($name);
                        $count_number_imgs = 1;
                        while (file_exists(public_path('images/footbridges/' . $name))) {
                            $name = $count_number_imgs . $name;
                            $count_number_imgs++;
                        }
                        Storage::disk('footbridges')->put($name, File::get($valor_file));
                        //Termina el proceso de guardado
                        //Actualización del registro en la bd
                        $image->name = $name;
                        $image->order = $order;
                        $image->url = url('images/footbridges/' . $name);
                        $image->save();
                        //var_dump("Entro a actualizar");
                        //Termina proceso de actualizacion
                        //Empieza eliminación en el Storage Path
                        Storage::disk('footbridges')->delete($anterior);
                        //Termina la eliminación en el Storage Path
                        //var_dump('Termino la actualización junto con la eliminacion');
                        $order++;
                    }
                }


                if($files[$i]  != null && $id[$i] == 'new'){
                    //var_dump("Entro a dar de alta");
                    // Se da de alta si no se encuentra en la base de datos
                    $valor_file = $files[$i];
                    $name = $valor_file->getClientOriginalName();
                    $count_number_imgs = 1;
                    while(file_exists(public_path('images/footbridges/'.$name))){
                        $name= $count_number_imgs.$name;
                        $count_number_imgs++;
                    }
                    Storage::disk('footbridges')->put($name,File::get($valor_file));
                    $image = new Image();
                    $image->name          = $name;
                    $image->order         = $order;
                    $image->url           = url('images/footbridges/'.$name);
                    $image->footbridge_id = $footbridge->id;
                    $image->save();
                    //dd("Guardo la imagen");
                    $order++;
                }


                if($files[$i] == null && $id[$i] != null && $id[$i]!='new' ){
                    //var_dump("Entra aqui el id esta lleno");
                    $valor_id = $id[$i];
                    $image = Image::findOrFail($valor_id);
                    //var_dump($image);
                    if ($image) {
                        $image->order = $order;
                        $image->save();
                    }
                    $order++;

                }


                if($files[$i] == null && empty($id[$i])){
                    var_dump("No debe hacer nada");
                }
            }

            //dd("Termino proceso");
        }


        $footbridge->save();



        return redirect($request->get('url_home_catalog'));

    }

    
    
    public function question_destroy($id)
    {
        $footbridge = Footbridge::findOrFail($id);
        return view('footbridge.delete',[
            'footbridge' => $footbridge
        ]);
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
        $footbridge_images = Image::ofFootbridge($footbridge);
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
