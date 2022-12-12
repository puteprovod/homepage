<?php

namespace App\Http\Requests\Resizer;

use Illuminate\Foundation\Http\FormRequest;
use JsonSerializable;

class StoreRequest extends FormRequest implements JsonSerializable
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
            'targetHeight' => 'required|integer',
            'targetWidth' => 'required|integer',
            'keepAspectRatio' => 'required|string',
            'keepHeight' => 'required|string',
            'keepWidth' => 'required|string',
            'images' => 'required|array'
        ];
    }
}
