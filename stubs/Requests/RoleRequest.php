<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return Auth::check() && Auth::user()->can('manage-user');
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
                'permissions' => 'sometimes|array'
            ];
        } elseif ($this->getMethod() == 'PUT') {
            return [
                'name' => 'required|unique:roles,name,' . $this->role->id,
                'permissions' => 'sometimes|array'
            ];
        }
    }
}