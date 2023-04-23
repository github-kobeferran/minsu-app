<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
    public function index()
    {
        abort_if(!auth()->user()->can('show user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $users = User::all();
        return view('userprofile.index', compact('users'));
    }
    
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('update user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('userprofile.edit', compact('user'));
    }

    public function userIndex(Request $request)
    {
        abort_if(!auth()->user()->can('view user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
    
        $keyword = $request->input('keyword');
        $department = $request->input('department');
    
        $users = User::when($keyword, function ($query, $keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('work_address', 'LIKE', "%{$keyword}%")
                        ->orWhere('department', 'LIKE', "%{$keyword}%");
                })
                ->when($department, function ($query, $department) {
                    $query->where('department', $department);
                })
                ->paginate(15);
    
        return view('userprofile.view', ['users' => $users, 'keyword' => $keyword]);
    }
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('user.profile', compact('user'));
}


    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(!auth()->user()->can('update user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
    
        auth()->user()->update($request->validated());
    
        if ($request->has('photo')) {
            $user->clearMediaCollection('photos');
            $user->addMediaFromRequest('photo')->toMediaCollection('photos');
        }
            
        return redirect()->route('userprofile.index')->with('success', 'User profile updated successfully');
    }
    
}
