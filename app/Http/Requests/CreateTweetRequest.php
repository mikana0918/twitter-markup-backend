<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateTweetRequest extends FormRequest
{
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
     * Get the validatio rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body' => 'required|max:140',
            // TODO: Add specific image validation specs
            'attachment_1' => [
                File::image()
            ],
            'attachment_2' => [
                File::image()
            ],
            'attachment_3' => [
                File::image()
            ],
            'attachment_4' => [
                File::image()
            ],
        ];
    }
}
