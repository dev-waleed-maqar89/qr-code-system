<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\ScoreCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\PaperScore;
use Illuminate\Http\Request;

class AdminScoreController extends Controller
{
    use ApiResponseTrait;
    public function index() {}


    public function store(ScoreCreateRequest $request)
    {
        $score = PaperScore::create([
            'paper_id' => $request->paper_id,
            'user_id' => $request->user_id,
            'admin_id' => $request->user()->id,
            'score' => $request->score
        ]);

        return $this->apiSuccess(data: compact(['score']), message: 'Score registered successfully');
    }
}