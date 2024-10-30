<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\ExamCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use Illuminate\Http\Request;

class AdminExamController extends Controller
{
    use ApiResponseTrait;
    public function index() {}

    public function store(ExamCreateRequest $request)
    {

        $exam = Exam::create(
            [
                'title' => $request->title,
                'exam_day' => $request->exam_day
            ]
        );

        return $this->apiSuccess(message: 'Exam created successfully', data: compact('exam'));
    }
}