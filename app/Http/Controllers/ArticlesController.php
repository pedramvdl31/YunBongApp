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
use Mail;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Article;


class ArticlesController extends Controller
{
     public function __construct() {
       if (Auth::user()) {
            switch (Auth::user()->roles) {
                case 1:
                    $this->layout = 'layouts.admins';
                    break;
                case 2:
                    $this->layout = 'layouts.admins';
                    break;
                case 3:
                    $this->layout = 'layouts.admins_simple';
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        if (Auth::check()) {
            switch (Auth::user()->roles) {
                case 1://SUPERADMIN 
                case 2://ADMIN
                case 3://SIMPLEADMIN
                    Job::ViewShareAdminPrivateData();
                    break;
                default:
                    Job::ViewShareAdminPrivateData();
                    break;
            }
        }
    }    
  
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $articles = Article::PrepareArticlesForIndex(Article::all());
        return view('articles.index')
            ->with('layout',$this->layout)
            ->with('articles',$articles);

    }
    /**
     * Adds a task 
     *
     * @return Response
     */
    public function getAdd()
    {
        return view('articles.add')
            ->with('layout',$this->layout);
    }  
    /**
     * Process Task Request
     *
     * @return Response
     */
    public function postAdd()
    {       
        Job::dump(Input::all());
        $validator = Validator::make(Input::all(), Article::$articles_add);
        if ($validator->passes()) {
            $_img = Input::get('celebrity_image');
            $tmp_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."articles".DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
            $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."articles".DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR;
            if (!file_exists($tmp_path)) {
                mkdir($tmp_path, 0777, true);
            }               
            if (!file_exists($new_path)) {
                mkdir($new_path, 0777, true);
            } 
            $oldpath = public_path($tmp_path.$_img);
            $newpath = public_path($new_path.$_img);
            if (file_exists($tmp_path.$_img)) {
                rename($oldpath, $newpath);
            }  
            $files = glob($tmp_path.'*'); // get all file names
            foreach($files as $file){ // iterate files
              if(is_file($file))
                unlink($file); // delete file
            }

            $articles_data = new Article;
            $articles_data->name = Input::get('name');
            $articles_data->title = Input::get('title');
            $articles_data->nicknames = Input::get('nicknames');
            $articles_data->net = Input::get('networth');
            $articles_data->dob = Input::get('dob');
            $articles_data->profession = Input::get('profession');
            $articles_data->nationality = Input::get('nationality');
            $articles_data->height = Input::get('height');
            $articles_data->weight = Input::get('weight');
            $articles_data->ethnicity = Input::get('ethnicity');
            $articles_data->salary = Input::get('salary');
            $articles_data->description = json_encode(Input::get('description'));
            $articles_data->image_src = Input::get('celebrity_image');
            $articles_data->status = 1;

            if ($articles_data->save()) {
                 Flash::success('Successfully added!');
                 return Redirect::route('articles_index');
            }
        }
        else {
             // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput(); 
        } 
        
    }  
    /**
     * /admins/tasks/edit.
     * @param $id - task_id
     * @return Response
     */
    public function getEdit($id = null)
    {
        if (isset($id)) {
            $articles = Article::PrepareArticlesForEdit(Article::find($id));
                return view('articles.edit')
                ->with('layout',$this->layout)
                ->with('articles',$articles);
        } else {
            Redirect::back();
        }
    } 
    /**
     * Process Task Edit Request
     *
     * @return Response
     */
    public function postEdit()
    {
        $validator = Validator::make(Input::all(), Article::$articles_add);
        if ($validator->passes()) {
            $id = Input::get('article_id');
            $articles_data = Article::find($id);
            if (isset($articles_data)) {
                $_img = Input::get('celebrity_image');
                $tmp_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."articles".DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
                $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."articles".DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR;
                if (!file_exists($tmp_path)) {
                    mkdir($tmp_path, 0777, true);
                }               
                if (!file_exists($new_path)) {
                    mkdir($new_path, 0777, true);
                } 
                $oldpath = public_path($tmp_path.$_img);
                $newpath = public_path($new_path.$_img);
                if (file_exists($tmp_path.$_img)) {
                    rename($oldpath, $newpath);
                    $tfiles = $new_path.$articles_data->image_src; // get all file names
                    if(file_exists($tfiles)){
                        unlink($tfiles); // delete file
                    }
                }  
                $files = glob($tmp_path.'*'); // get all file names
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }

                $articles_data->name = Input::get('name');
                $articles_data->title = Input::get('title');
                $articles_data->nicknames = Input::get('nicknames');
                $articles_data->net = Input::get('networth');
                $articles_data->dob = Input::get('dob');
                $articles_data->profession = Input::get('profession');
                $articles_data->nationality = Input::get('nationality');
                $articles_data->height = Input::get('height');
                $articles_data->weight = Input::get('weight');
                $articles_data->ethnicity = Input::get('ethnicity');
                $articles_data->salary = Input::get('salary');
                $articles_data->description = json_encode(Input::get('description'));
                $articles_data->image_src = Input::get('celebrity_image');
                $articles_data->status = 1;

                if ($articles_data->save()) {
                     Flash::success('Successfully added!');
                     return Redirect::route('articles_index');
                }
            }


        }
        else {
             // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput(); 
        } 
        
    }  

    public function postSearch()
    {
        $search_text = Input::get('searched_text');
        if (isset($search_text) && $search_text!='') {
            $articles = Article::PrepareForResultsPage(Article::where('status',1)->where('name', 'like', $search_text)->get());
            $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());
            return view('articles.results')
                ->with('layout','layouts.customize_layout')
                ->with('resultspage','1')
                ->with('articles',$articles)
                ->with('search_text',$search_text)
                ->with('more_articles',$more_articles);
        }
        Flash::error('Seatch query cannot be empty!');
        return Redirect::route('home_index');
    }  

    public function postSearchRand()
    {
        $articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy(DB::raw('RAND()'))->take(10)->get());
        $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());
        return view('articles.results')
            ->with('layout','layouts.customize_layout')
            ->with('resultspage','1')
            ->with('articles',$articles)
            ->with('more_articles',$more_articles);
    }  

    /**
     * /admins/tasks/view.
     * @param $id - task_id
     * @return Response
     */
    public function getView($id = null)
    {

    } 

    public function getRemove($id = null)
    {
        if (isset($id)) {
            $article = Article::find($id);
            if (isset($article)) {
                    $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."articles".DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR;
                    $tfiles = $new_path.$article->image_src; // get all file names
                    if(file_exists($tfiles)){
                        unlink($tfiles); // delete file
                    }
                if ($article->delete()) {
                    Flash::success('Successfully Removed!');
                    return Redirect::route('articles_index');
                }
            }
        }
    } 


  
}
