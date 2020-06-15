<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('jwt');
   }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Reply $reply)
    {
        $reply->likes()->create(['user_id' => auth()->id()]);
        //$reply->likes()->create(['user_id' => 1]);
        return response(new ReplyResource($reply), Response::HTTP_OK);
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
        return response(new ReplyResource($reply), Response::HTTP_OK);
    }
}
