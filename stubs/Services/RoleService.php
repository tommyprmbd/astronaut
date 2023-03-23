<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{
    public function save(array $data, Role $role = null)
    {
        DB::beginTransaction();
        try {
            if ($role == null)
                $role = Role::create($data);
            else {
                $role->name = $data['name'];
                $role->save();
            }
            
            if (count($data['permission']) > 0) {
                $role->syncPermissions($data['permission']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        DB::commit();

        return true;
    }
}