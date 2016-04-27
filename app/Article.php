<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
public static $articles_add = array(
        'name'=>'required',
        'networth'=>'required',
        'description'=>'required',
        'celebrity_image'=>'required'
    );


    static public function PrepareForPublicPage($data) {

    	if (isset($data)) {
    		foreach ($data as $dkey => $dvalue) {
				if(isset($dvalue['created_at'])) {
					$dvalue['created_at_html'] = date ( 'l jS M',  strtotime($dvalue['created_at']) );
				}    		
    		}
    	}
    	return $data;
    }

    static public function PrepareArticlesForEdit($data) {

        if (isset($data)) {
      
        }
        return $data;
    }
    
    static public function PrepareForFinalResult($data) {

        if (isset($data)) {
            if(isset($data['description'])) {


                    $des_t_4 = '';
                    $slugtxt = isset($data['description'])?$data['description']:'';
                    //PARSE FIRST SECION
                    $url2 = 'http://en.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$slugtxt.'&prop=extracts&indexpageids';

                    $json3 = file_get_contents($url2);


                    if (isset($json3)) {
                        $data3 = json_decode($json3);
                        if (isset($data3)) {
                            if (isset($data3->query->pageids[0])) {
                                $pageid = $data3->query->pageids[0];
                                if (isset($data3->query->pages->$pageid->extract)) {
                                    $des_t_4 = $data3->query->pages->$pageid->extract;
                                }
                            }
                        }
                    }
                    $tmp = strlen($des_t_4)>200?substr($des_t_4,0,200)."...":$des_t_4;
                    $data['short_description'] = strip_tags($tmp);


            }           
        }
        return $data;
    }

    

    static public function PrepareArticlesForIndex($data) {

    	if (isset($data)) {
    		foreach ($data as $dkey => $dvalue) {
                if(isset($dvalue['created_at'])) {
                    $dvalue['created_at_html'] = date ( 'Y/n/d g:ia',  strtotime($dvalue['created_at']) );
                }           
    
    		}
    	}
    	return $data;
    }

    
    static public function PrepareForResultsPage($data) {
    	if (isset($data)) {
    		foreach ($data as $dkey => $dvalue) {
				if(isset($dvalue['created_at'])) {
					$dvalue['created_at_html'] = date ( 'Y/n/d g:ia',  strtotime($dvalue['created_at']) );
				}    	
                if (isset($dvalue['description'])) {

                    $des_t = '';
                    $slugtxt = isset($dvalue['description'])?$dvalue['description']:'';
                    //PARSE FIRST SECION
                    $url = 'http://en.wikipedia.org/w/api.php?format=json&action=query&exintro=&explaintext=&titles='.$slugtxt.'&prop=extracts&indexpageids';

                    $json2 = file_get_contents($url);


                    if (isset($json2)) {
                        $data2 = json_decode($json2);
                        if (isset($data2)) {
                            if (isset($data2->query->pageids[0])) {
                                $pageid = $data2->query->pageids[0];
                                if (isset($data2->query->pages->$pageid->extract)) {
                                    $des_t = $data2->query->pages->$pageid->extract;
                                }
                            }
                        }
                    }
                    $tmp = strlen($des_t)>200?substr($des_t,0,200)."...":$des_t;
                    $dvalue['new_description'] = strip_tags($tmp);

                }    	
    		}
    	}
    	return $data;
    }
}
