<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\PaperCreateRequest;
use App\Http\Resources\Api\V1\Dashboard\PaperScoreResource;
use App\Http\Traits\ApiResponseTrait;
use App\Mail\Dashboard\UserScoreMail;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function scores(Request $request, Paper $paper)
    {
        $perPage = $request->per_page ?? 25;
        $scores = $paper->scores()->orderBy('score', 'desc')->paginate($perPage);
        $scores = PaperScoreResource::collection($scores);
        return $this->apiSuccess(data: compact('scores'));
    }

    public function finish_marking(Paper $paper)
    {
        foreach ($paper->scores as $score) {
            Mail::to($score->user->parent_email)->send(new UserScoreMail($score));
        }
        $paper->scores()->update(['is_marked' => 1]);
        return $this->apiSuccess(message: 'Marked successfully');
    }
}