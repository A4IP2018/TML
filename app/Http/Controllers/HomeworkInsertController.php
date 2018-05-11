<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ip_project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AddHomeWorkController extends Controller {
	
	public function insert_homework_form()
	{
      return view('homework_create');
	}
	
   public function insert_new_homework(Request $request){
      $description = $request->input('homework_description');
	  $course = $request->input('homework_course');
	  
	  if(strcmp($course,"IP fara Patrut :(")==0)
	  {
		  $id_course=0;
	  }
	  elseif(strcmp($course,"Curs 2")==0)
	  {
		  $id_course=1;
	  }
	  elseif(strcmp($course,"Curs 3")==0)
	  {
		  $id_course=3;
	  }
	  elseif(strcmp($course,"Curs 4")==0)
	  {
		  $id_course=4;
	  }
	  
	  $user = Auth::User();     
      $userId = $user->id;
	  
	  
      ip_project::insert('insert into homeworks (description,category_id,path,user_id) values(?)',[$desctiption],[$id_course],"/",[$userId]);
   }
}