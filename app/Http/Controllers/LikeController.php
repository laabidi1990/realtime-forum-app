<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Reply $reply)
    {
        //$reply->likes()->create(['user_id' => auth()->id()]);
        $reply->likes()->create(['user_id' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function dislike(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->id())->first()->delete();
    }
}
