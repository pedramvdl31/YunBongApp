<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;
use Redis;
use File;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;

class HomeController extends Controller
{

    public function __construct() {
        // DB::statement("ALTER TABLE articles ADD description_text_mb MEDIUMBLOB");
        $this->layout = "layouts.index-layouts.index";
        //CHECK IF THE HOMEPAGE IS SET
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

        public function getHomePage()
    {   
        $layout_title = 'layouts.customize_layout';
            return view('home.homepage')
            ->with('layout',$layout_title);
    }


}
