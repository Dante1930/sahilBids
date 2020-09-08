<?php
namespace App\Http\Controllers\Admin\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function addUser()
    {
        return view('admin.user.add_user');

    }
}
