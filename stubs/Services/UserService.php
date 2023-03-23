<?php
namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService extends BaseService
{
    public function save(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        DB::beginTransaction();
        try {
            if (!$user) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'remember_token' => Str::random(10),
                ]);
            } else {
                $user->name = $data['name'];
                $user->email = $data['email'];
                if ($data['password'] !== null)
                    $user->password = Hash::make($data['password']);
                
                $user->save();
            }

            if ($data['role'] != null) 
                $user->syncRoles([$data['role']]);

        } catch (\Exception $e) {
            DB::rollBack();

            return $e;
        }
        DB::commit();

        return true;
    }
}