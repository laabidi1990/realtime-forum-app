<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
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
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {   
        $request['slug'] = Str::slug($request->title);
        $question = auth()->user()->questions()->create($request->all());
        return response(new QuestionResource($question), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $request['slug'] = Str::slug($request->title);
        $question->update($request->only(['title', 'slug', 'body', 'category_id']));
        return response($question, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response('Question deleted ssuccessfully', Response::HTTP_NO_CONTENT);
    }
}
