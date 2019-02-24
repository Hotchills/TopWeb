<?php

namespace App\Http\Controllers;

use App\MainPage;
use Illuminate\Http\Request;
use Session;
use App\Page;
use Illuminate\Validation\Rule;

class MainPageController extends Controller {

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
    public function index() {
        //
        $AllMainPages= MainPage::all();
        return view('/vendor/voyager/mainpage/mainpage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
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

    /**
     * Display the specified resource.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function show(MainPage $mainPage) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function edit(MainPage $mainPage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainPage $mainPage) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainPage $mainPage) {
        //
    }

}
