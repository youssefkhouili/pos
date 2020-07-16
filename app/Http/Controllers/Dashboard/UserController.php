<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->where(function($query) use ($request) {

            return $query->when($request->search, function($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                             ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });

        })->latest()->paginate(3);

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => 'required|min:3|max:14',
            'last_name'         => 'required|min:3|max:14',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|confirmed',
            'image'             => 'image|max:5000',
            'permissions'       => 'required|min:1'
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }


        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', 'site.added_success');

        return redirect()->route('dashboard.users.index');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'        => 'required|min:3|max:14',
            'last_name'         => 'required|min:3|max:14',
            'email'             => ['required', Rule::unique('users')->ignore($user->id)],
            'image'             => 'image|max:5000',
            'permissions'       => 'required|min:1'
        ]);

        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {

            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }
        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        session()->flash('success', 'site.updated_success');

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
        }

        $user->delete();
        session()->flash('success', 'site.deleted_success');
        return redirect()->route('dashboard.users.index');
    }
}
