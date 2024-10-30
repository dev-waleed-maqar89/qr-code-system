<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\QuestionCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    use ApiResponseTrait;
    public function index($exam_id) {}

    public function store(QuestionCreateRequest $request)
    {

        $question = Question::create([
            'exam_id' => $request->exam_id,
            'question' => $request->question
        ]);

        return $this->apiSuccess(message: 'Question created successfully', data: compact('question'));
    }
}