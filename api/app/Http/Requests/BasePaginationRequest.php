<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasePaginationRequest extends FormRequest
{
    protected int $limitPerPage = 50;
    protected int $defaultValuePerPage = 5;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'perPage' => $this->input('perPage', $this->defaultValuePerPage),
            'page' => $this->input('page', 1),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'perPage'   => 'required|numeric|min:0|max:'.$this->limitPerPage,
            'page'      => 'required|int'
        ];
    }
}
