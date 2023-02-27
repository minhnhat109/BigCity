<?php

namespace App\Http\Requests\RoomCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomCategoryRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'                                                            => 'required|exists:room_categories,id',
            'name_room_category'                                                => 'required|min:5',
            'slug_room_category'                                               => 'required|min:5',
            'is_open'                                                       => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
           'id.required'                                         => 'Room category cannot be left empty',
           'id.exists'                                           => 'Room category does not exist in the system',
           'name_room_category.required'                             => 'Room category name cannot be left blank',
           'slug_room_category.required'                            => 'Room category slug cannot be left empty',
           'is_open.required'                                    => 'Status cannot be empty',
           'name_room_category.min'                                  => 'Room category name must be 5 characters or more',
           'slug_room_category.min'                                 => 'Room category slug must be 5 characters or more',
           'is_open.boolean'                                     => 'Status is selected only Yes/No',
        ];
    }
}
