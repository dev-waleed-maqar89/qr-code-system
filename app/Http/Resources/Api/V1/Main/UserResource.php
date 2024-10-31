<?php

namespace App\Http\Resources\Api\V1\Main;

use App\Http\Resources\Api\V1\Dashboard\PaperScoreResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'parent_email' => $this->parent_email,
            'total_score' => $this->total_score,
            'qr_code' => $this->qr_code,
            'scores' => PaperScoreResource::collection($this->scores)
        ];
    }
}