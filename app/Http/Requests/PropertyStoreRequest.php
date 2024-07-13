<?php

namespace App\Http\Requests;

use App\Enums\PropertyType;
use App\Models\PropertyAddress;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyStoreRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'bedroom' => ['required', 'integer', 'min:0', 'max:100'],
            'bathroom' => ['required', 'integer', 'min:0', 'max:100'],
            'floor' => ['required', 'integer', 'min:0', 'max:200'],
            'building_area' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'land_area' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'sold_at' => ['nullable', 'date', 'before_or_equal:today'],
            'type' => ['required', Rule::enum(PropertyType::class)],
            'images' => ['nullable', 'array', 'max:20'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,gif', 'max:4096'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'alpha_num', 'max:20'],
            'unit_number' => ['required', 'alpha_num', 'max:20'],
        ];
    }
}
