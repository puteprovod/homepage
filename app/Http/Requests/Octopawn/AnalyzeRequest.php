<?php

namespace App\Http\Requests\Octopawn;

use Illuminate\Foundation\Http\FormRequest;

class AnalyzeRequest extends FormRequest
{
    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'boardSituation' => 'required|array',
            'color' => 'required|string',
        ];
    }
}
