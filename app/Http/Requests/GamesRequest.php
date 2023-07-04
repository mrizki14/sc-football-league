<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GamesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'addMore.*.home_team_id' => ['required', 'unique:games', Rule::unique('games', 'home_team_id')->where('home_team_id', $this->input('addMore.*.home_team_id'))],
            'addMore.*.away_team_id' => ['required', 'unique:games', Rule::unique('games', 'away_team_id')->where('away_team_id', $this->input('addMore.*.away_team_id'))],
            'addMore.*.home_score' => 'nullable',
            'addMore.*.away_score' => 'nullable',

            
        ];
          // foreach ($request->addMore as $key => $value) {
        //     Game::create($value);
        // }
    }
}
