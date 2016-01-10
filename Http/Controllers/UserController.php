<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


	function ajaxResponse(Request $request){


		$json = file_get_contents('js/Quiz1.json');
		$obj = json_decode($json);

		$name =$request->input('q');
		$list=array();					

		foreach($obj as $o)
		{
			if (is_numeric(strpos($o->username, $name)))
			{
				$list[]=$o->username;
			}
		}

		return response()->json($list);



	}

	function formsubmit(Request $request){

		$json = file_get_contents('js/Quiz1.json');
		$obj = json_decode($json);

		$name =$request->input('srch-term');

		$element='';
		foreach($obj as $o)
		{
			if ($o->username==$name)
			{
				$element=$o;					
			}
		}

		if($element==='')
		{
			return view('page', ['error' => 'No match was found please try again! ']);
		}
		else{
				return view('page', ['id' => $element->id,'username'=>$element->username,'first_name'=>$element->first_name,'last_name'=>$element->last_name,'email'=>$element->email,'city'=>$element->city,'country'=>$element->country,'fav_color'=>$element->fav_color,'blog'=>$element->blog]);
			}


	}



}
