<?php

namespace src\controllers;

use Exception;
use src\requests\users\UserStoreRequest;
use src\requests\users\UserUpdateRequest;
use src\services\UserService;
use src\support\View;
use src\support\Redirect;

class UserController
{
    public function __construct(private UserService $UserService) {}

    public function index(): View
    {
        try {
            $users = $this->UserService->getAll();
            return view('users.index', ['users' => $users]);
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return view('users.index', ['users' => []]);
        }
    }

    public function store(UserStoreRequest $request): Redirect
    {
        try {
            $this->UserService->create($request->get());
            return redirect()->route('users.index')->withSuccess('User created successfully');
        } catch (Exception $e) {
            return redirect()->route('users.index')->withError($e->getMessage());
        }
    }

    public function edit(string $uuid): View
    {
        try {
            $user = $this->UserService->getByUuid($uuid);
            return view('users.edit', ['user' => $user]);
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return view('users.edit', ['user' => null]);
        }
    }

    public function update(UserUpdateRequest $request, string $uuid): Redirect
    {
        try {
            $this->UserService->update($request->get(), $uuid);
            return redirect()->route('users.index')->withSuccess('User updated successfully');
        } catch (Exception $e) {
            return redirect()->route('users.edit', ['uuid' => $uuid])->withError($e->getMessage());
        }
    }

    public function delete(string $uuid): Redirect
    {
        try {
            $this->UserService->delete($uuid);
            return redirect()->route('users.index')->withSuccess('User deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('users.index')->withError($e->getMessage());
        }
    }
}
