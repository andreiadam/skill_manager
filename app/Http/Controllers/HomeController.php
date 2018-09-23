<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('home')->with('users', $users);

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:5,20',
        ],[
            'first_name.required' => 'Please enter a Name',
            'last_name.required' => 'Please enter your Lastname',
            'email.email' => 'Invalid E-mail',
            'email.required' => 'Please enter your e-mail',
        ]);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();



        return redirect()->route('home')->with('status', 'Successfully create Users '.$user->first_name);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|between:5,20',
        ],[
            'first_name.required' => 'Please enter a Name',
            'last_name.required' => 'Please enter your Lastname',
            'email.email' => 'Invalid E-mail',
            'email.required' => 'Please enter your e-mail',
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('home')->with('status', 'Successfully updated User '.$user->first_name);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('home')->with('status', 'Successfully deleted User '.$user->first_name);
    }
}
