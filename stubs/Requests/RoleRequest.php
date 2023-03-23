<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->getMethod() == 'POST') {
            return [
                'name' => 'required|unique:roles,name',
                'permission' => 'sometimes|array'
            ];
        } elseif ($this->getMethod() == 'PUT') {
            return [
                'name' => 'required|unique:roles,name,' . $this->role->id,
                'permission' => 'sometimes|array'
            ];
        }
    }
}