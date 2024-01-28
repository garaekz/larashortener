<?php

namespace App\Http\Requests\Short;

use App\Models\App;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShortApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() instanceof App && auth()->user()->tokenCan('shorts:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'url', 'max:2048'],
            'code' => [
                'nullable',
                'alpha_num:ascii',
                'min:' . config('app.code_generator.min_length'),
                'max:255',
                Rule::unique('shorts', 'code')->where(function ($query) {
                    return $query->where('shortable_type', App::class)
                        ->where('shortable_id', auth()->user()->id);
                }),
            ],
            'expires_at' => ['nullable', 'date'],
        ];
    }
}
