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
            if(isset($data['description_summary'])) {
                $data['short_description'] = $data['description_summary'];
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
                if (isset($dvalue['description_summary'])) {

                    $dvalue['new_description'] = $dvalue['description_summary'];

                }    	
    		}
    	}
    	return $data;
    }
}
