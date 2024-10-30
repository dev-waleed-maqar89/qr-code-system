<?php

namespace App\Http\Resources\Api\V1\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaperScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'score' => $this->score,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->name
            ],
            'paper' => [
                'id' => $this->paper_id,
                'title' => $this->paper->title
            ],
            'admin' => [
                'id' => $this->admin_id,
                'name' => $this->admin->name
            ],
        ];
    }
}