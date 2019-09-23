<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        $roles = User::rolesList();

        return view('backend.users.create', compact('user', 'roles'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store()
    {
        /** @var User $user */
        $user = User::make($this->validateCreateRequest());
        $user->setPassword($user->password);
        $user->saveOrFail();

        return redirect()->route('admin.users.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Пользователь сохранен',
            ]
        ]);
    }

    public function edit(User $user)
    {
        $roles = User::rolesList();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $vr = $this->validateUpdateRequest($user);
        $user->update($vr);

        return redirect()->route('admin.users.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Пользователь изменен',
            ]
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'flash' => [
                'type' => 'success',
                'text' =>'Пользователь удален',
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function changePassword(Request $request)
    {
        if ($request->isMethod('patch')) {

            try {
                $this->validate($request,
                    [
                        'userId' => 'required',
                        'password' => 'required|string|min:4',
                    ],
                    [
                        'password.required' => 'Пароль не должен быть пустым',
                        'password.min' => 'Пароль не менее 4-х символов',
                    ]);

                $user = User::findOrFail($request->input('userId'));
                $user->setPassword($request->input('password'));
                $user->saveOrFail();

            } catch (\Illuminate\Validation\ValidationException $e) {
                $key = key($e->errors());
                $message = $e->errors()[$key][0];

                return back()->with([
                    'message' => $message,
                    'alert-type' => 'error',
                ]);
            }


            return back()->with([
                'flash' => [
                    'type' => 'info',
                    'text' =>'Пароль пользователя изменен успешно',
                ]
            ]);
        }

        return back()->with([
            'flash' => [
                'type' => 'error',
                'text' =>'Недопустимый метод',
            ]
        ]);
    }


    protected function validateCreateRequest()
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'username' => 'required|string|min:2|max:24|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);
    }

    protected function validateUpdateRequest(User $user)
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'username' => 'required|string|min:2|max:24|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);
    }
}
