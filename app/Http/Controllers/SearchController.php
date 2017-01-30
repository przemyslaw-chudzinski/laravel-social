<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function __construct()
    {

    }

    public function users(Request $request)
    {

      $data = $request->all();

      if(!isset($data['q'])){
        $data['q'] = "";
      }

      if(!isset($data['page'])){
        $data['page'] = "";
      }

      if($data['q'] === "" && $data['page'] === ""){
        return back();
      }

      $q = $data['q'];

      $results = User::where('firstName','like','%'.$q.'%')->orWhere('lastName','like','%'.$q.'%')->paginate(20);
      $results->setPath('search?q='.$q.'');
      
      $template_data = compact('results');
      return view('search.users',$template_data);
    }
}
