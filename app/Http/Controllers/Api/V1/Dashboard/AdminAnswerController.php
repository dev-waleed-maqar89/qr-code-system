<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\AnswerCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Answer;
use Illuminate\Http\Request;

class AdminAnswerController extends Controller
{
    use ApiResponseTrait;
    public function index($question_id) {}


    public function store(AnswerCreateRequest $request)
    {

        $answer = Answer::create([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'is_correct' => $request->is_correct
        ]);

        return $this->apiSuccess(message: 'Answer created successfully', data: compact('answer'));
    }
}