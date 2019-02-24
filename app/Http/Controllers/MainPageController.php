<?php

namespace App\Http\Controllers;

use App\MainPage;
use Illuminate\Http\Request;
use Session;
use App\Page;
use Illuminate\Validation\Rule;
use \TCG\Voyager\Facades\Voyager;

class MainPageController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  //  public function __construct()
  //   {
   //  $this->middleware('auth',['except'=>'index']); 
  //   $this->middleware('admin', ['except' => ['index']]);
 //  }
    public function mainpage($main) {


        if ($mainpage = MainPage::where('name', $main)->first()) {       
            $pages = $mainpage->pages;
            return view('mainpage', compact('mainpage', 'pages'));
        }
        abort(404);
    }

    public function index1() {
        //
        return view('CreateMainPage');
    }
  
    public function mainstore(Request $request) {
        
       $validatedData = $request->validate([
        'title' => 'required|unique:mainpage|max:100|min:3',
        'name'=> 'required|unique:mainpage|max:40|min:3',
        'body' => 'max:500',
        ]);
         
        $mainpage = new MainPage();
        $mainpage->name = $request->name;
        $mainpage->title = $request->title;
        $mainpage->body = $request->body;
        $mainpage->save();
      
        
        return redirect()->action('MainPageController@index',['main'=>$mainpage->name])->with('message', 'Success');

    
    }

 
   

}
