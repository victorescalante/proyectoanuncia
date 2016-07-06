<?php

namespace Anuncia\Http\Controllers;


use Anuncia\Http\Requests\FootbridgeRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Anuncia\Municipality;
use Anuncia\Footbridge;
use Anuncia\Photo;
use Anuncia\State;



class FootbridgeController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param FootbridgeRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(FootbridgeRequest $request)
    {

        $footbridge = new Footbridge($request->all());
        $footbridge->save();

        Flash::success('Footbridge '.$footbridge->name.' created');

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
        $images = Photo::ofFootbridge($footbridge);
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
        $images = Photo::ofFootbridge($footbridge);

        return view('footbridge.edit', [
            'footbridge' => $footbridge,
            'states'     => $states,
            'municipalities' => $municipalities,
            'images' => $images
        ]);



    }

    /**
     * @param FootbridgeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FootbridgeRequest $request, $id)
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


        $this->orderPhotos($request->get('order_img'));

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

    public function orderPhotos($photos){

        for($i=1;$i<count($photos);$i++){
            $photo = Photo::findOrFail($photos[$i-1]);
            $photo->order = $i;
            $photo->save();
        }

    }
}
