<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomMicRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
           // 'room_id'=> 'required|numeric',
            'room_owner_id'=> 'required|numeric',
            'mic_user_id'=> 'required|numeric',
            'mic_number'=> 'required|numeric',
            'status'=> 'required',
            'is_locked'=> 'required',
            
        ];
    }
}
