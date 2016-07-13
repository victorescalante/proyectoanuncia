<?php

namespace Anuncia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Anuncia\Post;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
      return view('page.home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalog(Request $request)
    {
        if(!empty($request->get('municipality'))){
            $footbridges = DB::table('footbridges')
                ->select('municipalities.name as namem','municipalities.id as idm','footbridges.id','footbridges.name as namef', 'images.path')
                ->join('images','footbridges.id','=','images.footbridge_id')
                ->join('municipalities','footbridges.municipality_id','=','municipalities.id')
                ->where('municipalities.id','=',$request->get('municipality'))
                ->groupBy('footbridges.name')
                ->orderBy('images.order','asc')
                ->paginate(3);
            return view('page.catalog',[
                'footbridges' => $footbridges
            ]);
        }else{
            $footbridges = DB::table('footbridges')
                ->select('municipalities.name as namem','municipalities.id as idm','footbridges.id','footbridges.name as namef', 'path')
                ->join('images','footbridges.id','=','images.footbridge_id')
                ->join('municipalities','footbridges.municipality_id','=','municipalities.id')
                ->groupBy('footbridges.name')
                ->orderBy('images.order','asc')
                ->paginate(3);
            return view('page.catalog',[
                'footbridges' => $footbridges
            ]);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){


        if(!empty($request->get('search'))){

             $footbridges = DB::table('footbridges')
                ->select('municipalities.name as namem','municipalities.id as idm','footbridges.id','footbridges.name as namef', 'images.path')
                ->join('images','footbridges.id','=','images.footbridge_id')
                ->join('municipalities','footbridges.municipality_id','=','municipalities.id')
                ->where('municipalities.id','like','%'.$request->get('search').'%')
                ->orWhere('municipalities.name','like','%'.$request->get('search').'%')
                ->orWhere('footbridges.name','like','%'.$request->get('search').'%')
                ->orWhere('footbridges.street','like','%'.$request->get('search').'%')
                ->groupBy('footbridges.name')
                ->orderBy('images.order','asc')
                ->paginate(3);

            //dd($footbridges);
            return view('page.catalog',[
                'footbridges' => $footbridges
            ]);

        }else{
            return redirect()->route('catalog_show_path');
        }


    }

    /**
     * This route is new
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('page.contact');
    }


    public function blog(){

        $posts = Post::paginate(2);

        return view('page.blog')->with('posts',$posts);

    }


    public function show_posts($id){

        $post = Post::findOrFail($id);
        return view('post.show')->with('post',$post);

    }


}


