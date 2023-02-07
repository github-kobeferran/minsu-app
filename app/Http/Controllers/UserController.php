<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * For SUPER ADMIN
     */

    public function getPendingUsers()
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->get();

        return view('admin.pending-users', compact(['users']));
    }

    /**
     * FOR EMPLOYER
     */
}
