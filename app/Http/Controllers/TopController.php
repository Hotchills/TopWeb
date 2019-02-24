<?php

namespace App\Http\Controllers;

use App\Top;
use Illuminate\Http\Request;
use Session;
use App\Page;
use App\UserProfile;
use App\MainPage;
use Auth;
use App\LikeTop;
use Illuminate\Validation\Rule;

class TopController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index1($main, $page) {
        //
        $id = MainPage::where('name', $main)->first()->id;
        $page = Page::where('mainpage_id', $id)->where('name', $page)->first();
        $Pageid = $page->id;

        return view('CreateTop', compact('Pageid'));
    }

    public function index($main, $slug, $top, Request $request) {
        //
        $one = $slug;
        $id = MainPage::where('name', $main)->first()->id;


        if ($page = Page::where('mainpage_id', $id)->where('name', $one)->first()) {

            $toptemp = Top::where('page_id', $page->id)->where('title', $top)->first();

            return view('SingleTopPage', compact('main', 'page', 'toptemp'));
        }
        abort(404);
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
            'title' => ['required', 'max:100', Rule::unique('tops')->where('page_id', $request->page_id)],
            'body' => 'required|max:1000',
        ]);

        $top = new Top();
        $top->page_id = $request->page_id;
        $top->title = $request->title;
        $top->body = $request->body;
        $top->user_id = Auth::id();
        $page = Page::find($top->page_id);
        $top->page()->associate($page);
        $top->save();
        $mainpage = MainPage::find($page->mainpage_id);
        $tops = Top::where('page_id', $page->id)->orderBy('id')->paginate(5);
        $user = Auth::user();
        $top->user()->associate($user);

        if ($userprofile = UserProfile::where('user_id', $top->user_id)->first()) {
            $userprofile->increment('nr_tops');
        } else {
            $userprofile = new UserProfile;
            $userprofile->country = $request->country;
            $userprofile->user_id = Auth::user()->id;
            $userprofile->overview = "";
            $userprofile->nr_tops = 1;
            $userprofile->nr_comments = 0;
            $userprofile->user()->associate(Auth::user());
        }
        $userprofile->save();

        //  return view('/AddTopsAfterCreatePage', ['Pagename' =>  $page->title,'PageID' =>  $page->id]);     
        return redirect()->action('PageController@index', ['main' => $mainpage->name, 'page' => $page->name, 'tops' => $tops])->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Top  $top
     * @return \Illuminate\Http\Response
     */
    public function show() {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Top  $top
     * @return \Illuminate\Http\Response
     */
    public function edit(Top $top) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Top  $top
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Top $top) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Top  $top
     * @return \Illuminate\Http\Response
     */
    public function destroy(Top $top) {
        //
    }

    public function incrementvotetop(Request $request) {

        $request->all();
        $topid = $request->topid;
        $user = Auth::user();
        $like = LikeTop::where('top_id', $topid)->where('user_id', $user->id)->first();

        if (count($like) > 0) {
            if ($like->liketop == 1) {
                $like->liketop = 0;
                $like->save();
            } else {
                $like->liketop = 1;
                $like->save();
            }
        } else {
            $like = new LikeTop();
            $like->top_id = $topid;
            $like->liketop = 1;  // 0-unknown 1-liked  2-disliked
            $like->user_id = $user->id;
            $like->save();
        }
        //    return response()->json(['status' => 'success'], 201);
        $likes = $like->upvotestop();
        $dislikes = $like->downvotestop();
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }

    public function decrementvotetop(Request $request) {

        $request->all();
        $topid = $request->topid;
        $user = Auth::user();

        $like = LikeTop::where('top_id', $topid)->where('user_id', $user->id)->first();
        if (count($like) > 0) {
            if ($like->liketop == 2) {
                $like->liketop = 0;
                $like->save();
            } else {
                $like->liketop = 2;
                $like->save();
            }
        } else {
            $like = new LikeTop();
            $like->top_id = $topid;
            $like->liketop = 2; // 0-unknown 1-like  2-means dislike
            $like->user_id = $user->id;
            $like->save();
        }

        $likes = $like->upvotestop();
        $dislikes = $like->downvotestop();
        //    return response()->json(['status' => 'success'], 201);
        
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }

}
