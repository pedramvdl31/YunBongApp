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
        do {
            $rands = Job::generateRandomString(7);
        } while ( count(Article::where('code',$rands)->first()) != 0 );
        // $validator = Validator::make(Input::all(), Article::$articles_add);
        // if ($validator->passes()) {
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

            if (file_exists($tmp_path.$_img) && !empty($_img)) {
                rename($oldpath, $newpath);
            }  

            $files = glob($tmp_path.'*'); // get all file names
            foreach($files as $file){ // iterate files
              if(is_file($file))
                unlink($file); // delete file
            }

            $articles_data = new Article;
            $articles_data->code = $rands;
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
            $articles_data->image_src = !empty($_img)?$_img:null;
            $articles_data->status = 1;


            $articles_data->description = Input::get('description');
            $tdes = Input::get('description');
            $des_re = "";
            $des_sum = "";
            $des_tt = "";
            if (isset($tdes)) {
                //PARSE ALL IN HTML
                $url = 'http://ko.wikipedia.org/w/api.php?action=parse&prop=text&page='.$tdes.'&format=json';
                $jsonf = file_get_contents($url);
                if (isset($jsonf)) {
                    $datas = json_decode($jsonf,true);
                    $myarray = array_values($datas);
                    if (isset($myarray[0]['text']['*'])) {
                        $des_re .= $myarray[0]['text']['*'];
                    }
                }

                //SUM

                $url = 'http://ko.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$tdes.'&prop=extracts&indexpageids';
                $json12 = file_get_contents($url);
                if (isset($json12)) {
                    $data22 = json_decode($json12);
                    if (isset($data22)) {
                        if (isset($data22->query->pageids[0])) {
                            $pageid = $data22->query->pageids[0];
                            if (isset($data22->query->pages->$pageid->extract)) {
                                $des_tt = $data22->query->pages->$pageid->extract;
                            }
                        }
                    }
                }
                $des_sum = strlen($des_tt)>200?substr($des_tt,0,200)."...":$des_tt;

            }
            
            $articles_data->description_text_mb = json_encode($des_re);
            $articles_data->description_summary = $des_sum;

            if ($articles_data->save()) {
                 Flash::success('Successfully added!');
                 return Redirect::route('articles_index');
            }
        // }
        // else {
        //      // validation has failed, display error messages    
        //     return Redirect::back()
        //     ->with('message', 'The following errors occurred')
        //     ->with('alert_type','alert-danger')
        //     ->withErrors($validator)
        //     ->withInput(); 
        // } 
        
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
        // $validator = Validator::make(Input::all(), Article::$articles_add);
        // if ($validator->passes()) {
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
                if (file_exists($tmp_path.$_img) && !empty($_img)) {
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
                $articles_data->image_src = !empty($_img)?$_img:null;
                $articles_data->status = 1;

                $articles_data->description = Input::get('description');
                $tdes = Input::get('description');
                $des_re = "";
                $des_sum = "";
                $des_tt="";
                if (isset($tdes)) {
                    //PARSE ALL IN HTML
                    $url = 'http://ko.wikipedia.org/w/api.php?action=parse&prop=text&page='.$tdes.'&format=json';
                    $jsonf = file_get_contents($url);
                    if (isset($jsonf)) {
                        $datas = json_decode($jsonf,true);
                        $myarray = array_values($datas);
                        if (isset($myarray[0]['text']['*'])) {
                            $des_re .= $myarray[0]['text']['*'];
                        }
                    }

                    //SUM

                    $url = 'http://ko.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$tdes.'&prop=extracts&indexpageids';
                    $json12 = file_get_contents($url);
                    if (isset($json12)) {
                        $data22 = json_decode($json12);
                        if (isset($data22)) {
                            if (isset($data22->query->pageids[0])) {
                                $pageid = $data22->query->pageids[0];
                                if (isset($data22->query->pages->$pageid->extract)) {
                                    $des_tt = $data22->query->pages->$pageid->extract;
                                }
                            }
                        }
                    }
                    $des_sum = strlen($des_tt)>200?substr($des_tt,0,200)."...":$des_tt;
                }
                $articles_data->description_text_mb = json_encode($des_re);
                $articles_data->description_summary = $des_sum;
                if ($articles_data->save()) {
                     Flash::success('Successfully added!');
                     return Redirect::route('articles_index');
                }
            }


        // }
        // else {
        //      // validation has failed, display error messages    
        //     return Redirect::back()
        //     ->with('message', 'The following errors occurred')
        //     ->with('alert_type','alert-danger')
        //     ->withErrors($validator)
        //     ->withInput(); 
        // } 
        
    }  

    public function postSearch()
    {
        $search_text = Input::get('searched_text');
        if (isset($search_text) && $search_text!='') {
            $articles_array = array();
            $n_search_array = explode(' ', $search_text);
            $articles = Article::where('status',1)->get();
            foreach ($articles as $ak => $av) {
                $exist = 0;
                $new_name_array = explode(' ', $av['name']);
                if (isset($new_name_array)) {
                    foreach ($new_name_array as $nk => $nv) {
                        if (isset($n_search_array)) {
                            foreach ($n_search_array as $nsak => $nsav) {
                                if (strtolower($nv) == strtolower($nsav)) {
                                    $exist = 1;
                                }
                            }
                        }
                    }
                }
                if ($exist == 1) {
                    array_push($articles_array, $av->id);
                }
            }
                $articles = Article::PrepareForResultsPage(Article::where('status',1)->whereIn('id', $articles_array)->get());
                $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());

                if (count($articles) < 1) {
                    $des_re = "";
                    $des_sum = "";
                    $des_tt = "";
                    //PARSE ALL IN HTML
                    $url = 'http://ko.wikipedia.org/w/api.php?action=parse&prop=text&page='.$search_text.'&format=json';
                    $jsonf = file_get_contents($url);
                    if (isset($jsonf)) {
                        $datas = json_decode($jsonf,true);
                        if (is_array($datas)) {
                            $myarray = array_values($datas);
                            if (isset($myarray[0]['text']['*'])) {
                                $des_re .= $myarray[0]['text']['*'];
                            }
                        }
                    }
                    //SUM
                    $url = 'http://ko.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$search_text.'&prop=extracts&indexpageids';
                    $json12 = file_get_contents($url);
                    if (isset($json12)) {
                        $data22 = json_decode($json12);
                        if (isset($data22)) {
                            if (isset($data22->query->pageids[0])) {
                                $pageid = $data22->query->pageids[0];
                                if (isset($data22->query->pages->$pageid->extract)) {
                                    $des_tt = $data22->query->pages->$pageid->extract;
                                }
                            }
                        }
                    }
                    $des_sum = strlen($des_tt)>200?substr($des_tt,0,200)."...":$des_tt;
                    if (isset($des_sum,$des_re) && !empty($des_sum) && !empty($des_re)) {
                        $articles_data = new Article();
                        $articles_data->name = str_replace('_', ' ', $search_text);
                        $articles_data->status = 1;
                        $articles_data->description_text_mb = json_encode($des_re);
                        $articles_data->description_summary = $des_sum;
                        if ($articles_data->save()) {
                            return redirect()->action('ArticlesController@getViewOne',$articles_data->id);
                        }
                    } else {
                        $search_text2 = str_replace(' ', '_', $search_text);

                        $des_re2 = "";
                        $des_sum2 = "";
                        $des_tt2 = "";
                        //PARSE ALL IN HTML
                        $url2 = 'http://ko.wikipedia.org/w/api.php?action=parse&prop=text&page='.$search_text2.'&format=json';
                        $jsonf2 = file_get_contents($url2);
                        if (isset($jsonf2)) {
                            $datas2 = json_decode($jsonf2,true);
                            if (is_array($datas2)) {
                                $myarray2 = array_values($datas2);
                                if (isset($myarray2[0]['text']['*'])) {
                                    $des_re2 .= $myarray2[0]['text']['*'];
                                }
                            }
                        }
                        //SUM
                        $url2 = 'http://ko.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$search_text2.'&prop=extracts&indexpageids';
                        $json12 = file_get_contents($url2);
                        if (isset($json12)) {
                            $data222 = json_decode($json12);
                            if (isset($data222)) {
                                if (isset($data222->query->pageids[0])) {
                                    $pageid2 = $data222->query->pageids[0];
                                    if (isset($data222->query->pages->$pageid2->extract)) {
                                        $des_tt2 = $data222->query->pages->$pageid2->extract;
                                    }
                                }
                            }
                        }
                        $des_sum2 = strlen($des_tt2)>200?substr($des_tt2,0,200)."...":$des_tt2;
                        if (isset($des_sum2,$des_re2) && !empty($des_sum2) && !empty($des_re2)) {
                            $articles_data = new Article();
                            $articles_data->name = $search_text;
                            $articles_data->status = 1;
                            $articles_data->description_text_mb = json_encode($des_re2);
                            $articles_data->description_summary = $des_sum2;
                            if ($articles_data->save()) {
                                return redirect()->action('ArticlesController@getViewOne',$articles_data->id);
                            }  
                        }
                    }

                }
                return view('articles.results')
                    ->with('layout','layouts.customize_layout')
                    ->with('resultspage','1')
                    ->with('articles',$articles)
                    ->with('search_text',$search_text)
                    ->with('more_articles',$more_articles);
        }
        Flash::error('Search query cannot be empty!');
        return Redirect::route('home_index');
    }  

    public function postSearchRand()
    {
        $count = count(Article::all());
        return redirect()->action('ArticlesController@getViewOne',rand(1, $count));
    }  
    public function getSearchRand()
    {
        $count = count(Article::all());
        return redirect()->action('ArticlesController@getViewOne',rand(1, $count));
    }  

    public function getViewOne($id = null)
    {
        if (isset($id)) {
            $articles = Article::PrepareForFinalResult(Article::find($id));
            if (isset($articles)) {
                if (isset($articles->name)&&!empty($articles->name)) {
                    return redirect()->action('ArticlesController@getViewOneName',str_replace(' ','-',$articles->name));
                }
                $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());

                if (isset($articles['description_text_mb'])) {
                    $des_re = json_decode($articles['description_text_mb']);
                }
                if (isset($articles)) {
                    return view('articles.final_result')
                        ->with('resultspage','1')
                        ->with('articles',$articles)
                        ->with('layout','layouts.result')
                        ->with('des_re',$des_re)
                        ->with('more_articles',$more_articles);
                }
            }
        }
        
    } 
    public function getViewOneName($name = null)
    {
        if (isset($name)) {
            $articles = Article::PrepareForFinalResult(Article::where('name',str_replace('-', ' ', $name))->first());
            if (isset($articles)) {
                $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());

                if (isset($articles['description_text_mb'])) {
                    $des_re = json_decode($articles['description_text_mb']);
                }
                if (isset($articles)) {
                    return view('articles.final_result')
                        ->with('resultspage','1')
                        ->with('articles',$articles)
                        ->with('layout','layouts.result')
                        ->with('des_re',$des_re)
                        ->with('more_articles',$more_articles);
                }
            }
        }
        
    } 

    public function getViewRandByName($name = null)
    {
        if (!isset($name)) {
            Job::GetAllArticles();
        }
        return view('articles.final_result')
        ->with('resultspage','1')
        ->with('articles',$articles)
        ->with('layout','layouts.result')
        ->with('des_re',$des_re)
        ->with('more_articles',$more_articles);
    } 


    public function getViewByName($name = null,$id = null)
    {
        $new_name = urldecode($name);
        $articles = Article::PrepareForFinalResult(Article::find($id));
        $more_articles = Article::PrepareForResultsPage(Article::where('status',1)->orderBy('id', 'desc')->take(10)->get());
        if (isset($articles,$new_name)) {
            return view('articles.final_result')
                ->with('resultspage','1')
                ->with('articles',$articles)
                ->with('new_name',$new_name)
                ->with('layout','layouts.result')
                ->with('more_articles',$more_articles);
        }
    } 


    public function getRemoveArt($idt = null)
    {
        $sp = DIRECTORY_SEPARATOR;
        if (isset($idt)) {
            $article = Article::find($idt);
            if (isset($article)) {
                    $new_path = "assets".$sp."images".$sp."articles".$sp."prm".$sp;
                    if (isset($article->image_src) && $article->image_src != '') {
                        $tfiles = $new_path.$article->image_src; // get all file names
                        if (is_dir($new_path)) {
                            if(file_exists($tfiles)){
                                unlink($tfiles); // delete file
                            }
                        }
                    }
                if ($article->delete()) {
                    Flash::success('Successfully Removed!');
                    return Redirect::route('articles_index');
                }
            } else {
                Job::dump('article not found.');
            }
        } else {
            Job::dump('ID not found.');
        }
    } 


  
}
