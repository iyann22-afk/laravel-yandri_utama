<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser(array $data, array $roles = [])
    {
        DB::beginTransaction();
        try {
            // Enkripsi password sebelum disimpan
            $data['password'] = Hash::make($data['password']);
            $user = $this->userRepository->createUser($data);
            
            if (!empty($roles)) {
                $user->roles()->sync($roles);
            }
            
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}