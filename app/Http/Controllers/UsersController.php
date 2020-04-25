<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $you = auth()->user();
        $users = User::paginate(10);

        return view('dashboard.admin.usersList', compact('users', 'you'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('dashboard.admin.userShow', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('dashboard.admin.userEditForm', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:1|max:256',
            'email' => 'required|email|max:256'
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->organisation = $request->input('organisation');
        $user->save();
        $user->assignRole('user');
        $request->session()->flash('message', 'Successfully updated user');

        return redirect()->route('users.index')->with('info', 'Successfully edited user');;
    }

    /**
     * Create a user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $you = auth()->user();

        return view('dashboard.admin.userAdd', compact('you'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'organisation' => ['required', 'string', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $you = auth()->user();
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->organisation = $request->input('organisation');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = now();
        $user->assignRole('user');
        $user->save();
        $user->password = $request->input('password');
        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('users.index')->with('success', 'Successfully created user');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user)
        {
            $user->delete();
        }

        return redirect()->route('users.index')->with('error', 'User deleted Successfully!');;;
    }
}
