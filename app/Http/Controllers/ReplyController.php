<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Question $question, Request $request)
    {
        $question->replies()->create([
            'body' => $request->body,
            'question_id' => $question->id,
            'user_id' => Auth::id(),
        ]);

        return response('Your reply added successfully', Response::HTTP_CREATED);
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
    public function update(Request $request, Question $question)
    {
        $question->replies()->update(['body' => $request->body]);
        return response('Your reply updated successfully', Response::HTTP_OK);
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
        return response('Your reply deleted successfully', Response::HTTP_NO_CONTENT);
    }
}
