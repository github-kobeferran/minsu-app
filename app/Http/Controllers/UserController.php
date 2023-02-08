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

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.pending-users', compact(['users']));
    }


    public function approveUser(User $user)
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $user->approved = true;
        $user->save();

        session()->flash('success', $user->name . ' has been approved');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return redirect()->route('admin.pending-users')->with([
            'users' => $users,
        ]);
    }

    public function declineUser(User $user)
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $user->delete();

        session()->flash('primary', $user->name . ' has been declined');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return redirect()->route('admin.pending-users')->with([
            'users' => $users,
        ]);
    }

    /**
     * FOR EMPLOYER
     */
}
