<?php

namespace App\Http\Requests\Api\V1\Dashboard;

use App\Models\Paper;
use Illuminate\Foundation\Http\FormRequest;

class ScoreCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $paper = Paper::find($this->paper_id);
        $maxScore = $paper->max_score;
        return [
            'paper_id' => ['required', 'exists:papers,id'],
            'user_id' => ['required', 'exists:users,id'],
            'score' => ['required', 'numeric', 'min:0', 'max:' . $maxScore],
        ];
    }

    public function messages(): array
    {
        return [
            'paper_id.required' => __('validation/scorecreate.paper_id.required'),
            'paper_id.exists' => __('validation/scorecreate.paper_id.exists'),
            'user_id.required' => __('validation/scorecreate.user_id.required'),
            'user_id.exists' => __('validation/scorecreate.user_id.exists'),
            'score.required' => __('validation/scorecreate.score.required'),
            'score.numeric' => __('validation/scorecreate.score.numeric'),
            'score.min' => __('validation/scorecreate.score.min'),
            'score.max' => __('validation/scorecreate.score.max'),
        ];
    }
}
