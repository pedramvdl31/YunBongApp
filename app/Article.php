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
            if(isset($data['description'])) {
                $data['description_new'] = json_decode($data['description']);
            }           
        }
        return $data;
    }
    
    static public function PrepareForFinalResult($data) {

        if (isset($data)) {
            if(isset($data['description'])) {
                $data['description_new'] = json_decode($data['description']);

                $des_temp = json_decode($data['description']);
                $tmp = strlen($des_temp)>200?substr($des_temp,0,200)."...":$des_temp;
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
                    $des_temp = json_decode($dvalue['description']);
                    $tmp = strlen($des_temp)>200?substr($des_temp,0,200)."...":$des_temp;
                    $dvalue['new_description'] = strip_tags($tmp);
                }    	
    		}
    	}
    	return $data;
    }
}
