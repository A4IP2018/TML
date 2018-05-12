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
	  $name=$request->input("homework_name");
	  $id_course = ip_project::table('courses')->where($course, '=', 'course_name')->get();
	  //returns the id of the selected course
	  $user = Auth::User();     
      $userId = $user->id;
	  //returns the id of the logged in user.
	  $format_string=$request->input('homework_formats');
	  $slug=str_replace(' ','.',$format_string)
	  
	  
      ip_project::insert('insert into homeworks (description,name,category_id,user_id) values(?)',[$desctiption],[$name],[$slug],[$id_course],[$userId]);
   }
}