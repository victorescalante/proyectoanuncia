<?php

namespace Anuncia\Http\Controllers;

use Illuminate\Http\Request;

use Anuncia\Http\Requests;
use Illuminate\Support\Facades\Redirect;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('page.contact');
    }

    /**
     * This route is new
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalog()
    {
        return view('page.catalog');
    }
}


