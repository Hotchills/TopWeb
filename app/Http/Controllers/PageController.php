<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\MainPage;
use App\Comment;
use Session;
use App\Top;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class PageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($main, $slug, Request $request) {
        //
        $one = $slug;
        $id = MainPage::where('name', $main)->first()->id;

        if ($page = Page::where('mainpage_id', $id)->where('name', $one)->first()) {

            $tops = Top::where('page_id', $page->id)->orderBy('id')->paginate(5);
            if ($request->ajax()) {
                //  $top = Top::where('id', $returntyp)->first();
                return view('TopsPage', ['tops' => $tops])->render();
            }
            return view('page', compact('main', 'page', 'tops'));
        }
        abort(404);
    }

    public function index1($main) {

        $MainPageid = MainPage::where('name', $main)->first()->id;
        return view('/CreatePage', compact('MainPageid'));
    }
    
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => ['required','min:3', 'max:50', Rule::unique('pages')->where('mainpage_id', $request->mainpage_id)],
            'title' => ['required','min:3', 'max:100', Rule::unique('pages')->where('mainpage_id', $request->mainpage_id)],
            'body' => 'max:500',
        ]);

        $page = new Page();
        $page->page_type = $request->page_type;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->body = $request->body;
        $page->mainpage_id = $request->mainpage_id;
        $mainpage = MainPage::find($page->mainpage_id);
        $page->mainpage()->associate($mainpage);
        $page->save();

        $page_id = $page->id;
        $page_name = $page->name;
        $mainpage_name = $mainpage->name;
        $tops = Top::where('page_id', $page->id)->orderBy('id')->paginate(5);

        Session::flash('success', 'page done');

        return redirect()->action('PageController@index', ['main' => $mainpage->name, 'page' => $page->name, 'tops' => $tops])->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
