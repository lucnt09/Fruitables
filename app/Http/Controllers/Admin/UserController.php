<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const PATH_FOLDER = 'dashboard.admin.users.';

    public function index()
    {
        $userData = User::query()->orderByDesc('id')->paginate(10);
        return view(self::PATH_FOLDER . __FUNCTION__, compact('userData'));
    }

    public function toggleStatus(User $user)
{
    if ($user->type === 'admin') {
        return redirect()->back()->with('error', 'Không thể tắt tài khoản admin.');
    }

    // Đảo ngược trạng thái của tài khoản nếu không phải admin
    $user->is_active = !$user->is_active;
    $user->save();

    return redirect()->back()->with('success', 'Trạng thái tài khoản đã được cập nhật.');}
}
