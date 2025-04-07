<?php

namespace src\services;

use Exception;
use src\repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $UserRepository) {}

    public function getAll()
    {
        return $this->UserRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->UserRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        try {
            $user = $this->getByUuid($uuid);
            if (!$user) {
                throw new Exception('User not found');
            }
            return $this->UserRepository->updateByUuid($uuid, $data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $uuid)
    {
        try {
            $user = $this->getByUuid($uuid);
            if (!$user) {
                throw new Exception('User not found');
            }
            return $this->UserRepository->deleteByUuid($uuid);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getByUuid(string $uuid)
    {
        return $this->UserRepository->getByUuid($uuid);
    }
}
