<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\ScoreCreateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Paper;
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

    public function update(Request $request, PaperScore $score)
    {
        $paper = Paper::find($score->paper_id);
        $request->validate([
            'score' => ['required', 'numeric', 'min:0', 'max:' . $paper->max_score]
        ]);
        if ($score->is_marked == 1) {
            return $this->apiError(message: 'Score already marked', code: 400);
        }
        $score->update([
            'score' => $request->score
        ]);
        return $this->apiSuccess(message: 'Score updated successfully');
    }
}