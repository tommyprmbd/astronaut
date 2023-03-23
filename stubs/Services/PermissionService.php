<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService extends BaseService
{
    public static function groupListing($model = null): array
    {
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

    public function save(array $data, Permission $permission = null)
    {
        try {
            if ($permission == null)
                $permission = Permission::create($data);
            else {
                $permission->name = $data['name'];
                $permission->save();
            }
        } catch (\Exception $e) {
            return $e;
        }

        return true;
    }
}