<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Top;
use App\Page;
use App\MainPage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MovieController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($main, $page) {
        //
        $id = MainPage::where('name', $main)->first()->id;
        $pagetemp = Page::where('mainpage_id', $id)->where('name', $page)->first();
        $Pageid = $pagetemp->id;
        return view('AddMovieInDB', compact('Pageid', 'main', 'page'));
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
        //
        if ($request->ajax()) {
           $validator = \Validator::make($request->all(),[
                'title' => ['required', 'max:100', Rule::unique('tops')->where('page_id', $request->page_id)],
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errors' =>$validator->errors()->all()]);
            } else {
                $top = new Top();
                $top->page_id = $request->page_id;
                $top->user_id = $request->user_id;
                $top->title = $request->title;
                $top->body = '0';
                $page = Page::find($top->page_id);
                $top->page()->associate($page);
                $top->save();

                $movie = new Movie();
                $movie->TMDBid = $request->TMDBid;
                $movie->title = $request->title;
                $movie->poster_path = $request->poster_path;
                $movie->release_date = $request->release_date;
                $movie->overview = $request->overview;
                $movie->vote_average = $request->vote_average;
                $movie->vote_count = $request->vote_count;
                $movie->top_id = $top->id;
                $movie->top()->associate($top);
                $movie->save();

                return response()->json(['msg' => 'movie added']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie) {
        //
    }

}
