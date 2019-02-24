<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        //
        return view('UserProfile');
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

        if (Auth::user()->userprofile) {
            if ($request->has('country')) {
                Auth::user()->userprofile->country = $request->country;
                Auth::user()->userprofile->save();
                return redirect()->back()->with('message', 'Country updated');
            }

            if ($request->has('overview')) {
                Auth::user()->userprofile->overview = $request->overview;
                Auth::user()->userprofile->save();
                return redirect()->back()->with('message', 'overview updated');
            }
        } else {
            if ($request->has('country')) {
                $temp = new UserProfile;
                $temp->country = $request->country;
                $temp->user_id = Auth::user()->id;
                $temp->overview = 0;
                $temp->nr_tops = 0 ;
                $temp->nr_comments = $temp->nrcomments();
                $temp->user()->associate(Auth::user());
                $temp->save();

                return redirect()->back()->with('message', 'Country added');
            }
            if ($request->has('overview')) {
                $temp = new UserProfile;
                $temp->overview = $request->overview;
                $temp->country = 0;
                $temp->nr_tops = 0;
                $temp->nr_comments = 0;
                $temp->user_id = Auth::user()->id;
                $temp->user()->associate(Auth::user());
                $temp->save();
                return redirect()->back()->with('message', 'overview added');
            }
        }


        return redirect()->back()->with('message', 'error');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile) {
        //
    }

}
