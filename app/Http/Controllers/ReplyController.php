<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Events\NewReplyEvent;
use App\Events\DeleteReplyEvent;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReplyResource;
use App\Notifications\NewReplyNotification;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('jwt', ['except' => ['index', 'show']]);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies()->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, ReplyRequest $request)
    {
        $reply = $question->replies()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
        $user = $question->user;
        $user->notify(new NewReplyNotification($reply));
        broadcast(new NewReplyEvent(new ReplyResource($reply)))->toOthers();    
        return response(new ReplyResource($reply), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, Question $question, Reply $reply)
    {
        $reply->update($request->only(['body']));
        return response(new ReplyResource($reply), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response(new ReplyResource($reply), Response::HTTP_NO_CONTENT);
    }
}
