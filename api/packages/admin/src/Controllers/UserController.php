<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\ApiController;
use Cache;
use SHOP\Admin\Models\AdminUser;
use Illuminate\Http\Request;
use Hash;

class UserController extends ApiController
{
    protected $model = AdminUser::class;

    public $filter = [
        'role_id',
        'email',
        'username',
        'full_name',
        'phone',
        'state',
        'status',
        'locked',
    ];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function resetPass(Request $request)
    {
        $form = $request->validate([
            'uid' => 'required',
            'admin_password' => 'required',
            'new_password' => 'required|min:10',
        ]);

        $authUser = auth()->user();
        $match_admin_pass = Hash::check($form['admin_password'], $authUser->password);

        if($authUser->role_id == 1 && $match_admin_pass) {
            $user = AdminUser::findOrFail($form['uid']);
            $user->password = bcrypt($form['new_password']);

            Cache::delete('shop-users.' . $user->id);

            return [
                'success' => $user->save()
            ];
        }
        return [
            'success' => false
        ];
    }

    public function changePass(Request $request)
    {
        $form = $request->validate([
            'uid' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|min:10'
        ]);

        /**
         * @var AdminUser $authUser
         */
        $authUser = auth()->user();
        $match_user_pass = Hash::check($form['current_password'], $authUser->password);

        if($match_user_pass) {
            $authUser->password = bcrypt($form['new_password']);

            Cache::delete('shop-users.' . $authUser->id);

            return [
                'success' => $authUser->save()
            ];
        }
        return [
            'success' => false
        ];
    }
}
