<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\PaperCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPaperController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //
    }


    public function store(PaperCreateRequest $request)
    {
        $uuid = Str::uuid();
        $paper = Paper::create([
            'title' => $request->title,
            'max_score' => $request->max_score,
            'code' => $uuid
        ]);

        return $this->apiSuccess(message: 'Paper created successfully', data: compact('paper'));
    }

    public function scores(Paper $paper)
    {

        $scores = $paper->scores()->paginate(10);
        return $this->apiSuccess(data: compact('scores'));
    }
}