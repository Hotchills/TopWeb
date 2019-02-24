<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Top;
use App\UserProfile;
use App\Like;
use Illuminate\Foundation\Auth\User;
use Auth;
use Purifier;

class CommentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
      public function __construct()
      {
      $this->middleware('auth',['except'=>'store']);
      }
     */
    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }
    
    
    public function index($top_id) {
        //
        $top = Top::find($top_id);
        $commentsData = [];
        $top->comments->user;
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
    public function store(Request $request, $top_id) {
        $top = Top::find($top_id);
        if (Auth::check()) {
            $u_id = Auth::id();
        } else {
            return redirect()->back()->with('message', 'You need to login');
        }
        $comment = new Comment();
        $comment->replay_id = NULL;
        $comment->user_id = $u_id;
        $comment->body = Purifier::clean($request->body);
        $comment->top()->associate($top);
        $comment->approuved = 1; //0-default , 1 - needs to be approuved by admin/moderator 2 - show comment 3 - deleted
        $user =  Auth::user();
        $comment->user()->associate($user);
        if ($userprofile = UserProfile::where('user_id', $comment->user_id)->first()) {
            $userprofile->increment('nr_comments');
        } else {
            $userprofile = new UserProfile;
            $userprofile->country = 0;
            $userprofile->user_id = Auth::user()->id;
            $userprofile->overview = "";
            $userprofile->nr_tops = 0;
            $userprofile->nr_comments = 1;
            $userprofile->user()->associate(Auth::user());
        }
        $userprofile->save();
        $comment->save();
        return redirect()->back()->with('message', 'Comment added');
    }

    public function storereplay(Request $request, $top_id, $parent_id) {

        $top = Top::find($top_id);
        if (Auth::check()) {
            $u_id = Auth::id();
        } else {
            return redirect()->back()->with('message', 'You need to login');
        }
        $comment = new Comment();
        $comment->replay_id = $parent_id;
        $comment->user_id = $u_id;
        $comment->body =Purifier::clean($request->body);
        $comment->top()->associate($top);
        $user = User::find($comment->user_id);
        $comment->user()->associate($user);
        $comment->approuved = 1; //0-default , 1 - needs to be approuved by admin/moderator 2 - show comment 3 - deleted

        $comment->save();
        return redirect()->back()->with('message', 'Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function editcomment(Request $request) {
        
        $temid=$request->commentid;
        $comment=Comment::where('id', $temid)->first();
        $comment->body=Purifier::clean($request->body);
        $comment->save();
        
         return redirect()->back()->with('message', 'Comment edit done');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment) {
        //
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function deletecomment(Request $request) {
        //
        $request->all();
        $temp = $request->commentid;
        $comment = Comment::where('id', $temp)->first();
        //   $comment=Comment::where($temp,'id')->get();
        $comment->approuved = 3;//0-show  , 1 - needs to be approuved by admin/moderator 2 -  / 3 - deleted
        $comment->save();

        return redirect()->back()->with('message', 'Comment deleted');
    }

    public function incrementvote(Request $request) {

        $commentid = $request->commentid;
        $user = Auth::user();

        $like = Like::where('comment_id', $commentid)->where('user_id', $user->id)->first();
        if (count($like) > 0) {
            if ($like->like == 1) {
                $like->like = 0;
                $like->save();
            } else {
                $like->like = 1;
                $like->save();
            }
        } else {
            $like = new Like();
            $like->comment_id = $commentid;
            $like->like = 1;  // 0-unknown 1-liked  2-disliked
            $like->user_id = $user->id;
            $like->save();
        }
        $likes = $like->upvotescomment();

        $dislikes = $like->downvotescomment();

        $comment = Comment::find($request->commentid);
        $comment->up_vote = $likes;
        $comment->down_vote = $dislikes;
        $comment->save();

        //    return response()->json(['status' => 'success'], 201);
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }

    public function decrementvote(Request $request) {

        $request->all();
        $commentid = $request->commentid;
        $user = Auth::user();

        $like = Like::where('comment_id', $commentid)->where('user_id', $user->id)->first();
        if (count($like) > 0) {
            if ($like->like == 2) {
                $like->like = 0;
                $like->save();
            } else {
                $like->like = 2;
                $like->save();
            }
        } else {
            $like = new Like();
            $like->comment_id = $commentid;
            $like->like = 2; // 0-unknown 1-like  2-means dislike
            $like->user_id = $user->id;
            $like->save();
        }

        $likes = $like->upvotescomment();
        $dislikes = $like->downvotescomment();

        $comment = Comment::find($request->commentid);
        $comment->up_vote = $likes;
        $comment->down_vote = $dislikes;
        $comment->save();

        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }

}
