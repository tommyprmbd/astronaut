<?php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService
{
    public static function groupListing($model = null): array
    {
        // dd(get_class($model));
        // if ($model && (!$model instanceof User || !$model instanceof Role))
        //     return throw new Exception("Invalid class");

        $list = [];

        $permissions = Permission::orderBy('id')->pluck('name');
        
        $allowed = [];
        if ($model && $model instanceof User) {
            $allowed = $model->getPermissionNames()->toArray();
        }

        if ($model && $model instanceof Role) {
            $allowed = $model->permissions->pluck('name')->toArray();
        }
        
        foreach ($permissions as $value) {
            $explode = explode('.', $value);
            $group = ucwords($explode[0]);
            array_shift($explode);
            $name = ucwords(implode(' ', str_replace('-', ' ', $explode)));

            $checked = in_array($value, $allowed);

            if (!array_key_exists($group, $list)) {
                $list[$group] = [
                    $value => [
                        'name' => $name,
                        'checked' => $checked
                    ]
                ];
            } else {
                $list[$group][$value] = [
                    'name' => $name,
                    'checked' => $checked
                ];
            }
        }

        return $list;
    }
}