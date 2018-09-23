<?php

namespace App\Http\Controllers;

use App\AvailableSkill;
use App\User;
use App\UserSkill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;


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
        $availableSkills = AvailableSkill::all();
        return view('users.create')
            ->with('availableSkills', $availableSkills)
            ->with('isEdit', false)
            ->with('userskills', []);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|between:5,20',
        ], [
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

        if (!empty($request->skill)) {
            foreach ($request->skill as $skill) {
                $new_skill = new UserSkill();
                $new_skill->user_id = $user->id;
                $new_skill->skill_id = $skill['id'];
                $new_skill->level = $skill['level'];
                $new_skill->save();
            }
        }


        return redirect()->route('home')->with('status', 'Successfully create Users ' . $user->first_name);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $availableSkills = AvailableSkill::all();
        return view('users.edit')
            ->with([
                'user' => $user,
                'availableSkills' => $availableSkills,
                'isEdit' => true,
                'userskills' => User::getLastSkills($id),
            ]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|between:5,20',
        ], [
            'first_name.required' => 'Please enter a Name',
            'last_name.required' => 'Please enter your Lastname',
            'email.email' => 'Invalid E-mail',
            'email.required' => 'Please enter your e-mail',
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (!empty($request->skill)) {
            foreach ($request->skill as $skill) {
                $new_skill = new UserSkill();
                $new_skill->user_id = $user->id;
                $new_skill->skill_id = $skill['id'];
                $new_skill->level = $skill['level'];
                $new_skill->save();
            }
        }

        return redirect()->route('home')->with('status', 'Successfully updated User ' . $user->first_name);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('home')->with('status', 'Successfully deleted User ' . $user->first_name);
    }

    public function details($id)
    {
        $user = User::find($id);
        $allSkills = UserSkill::with('aSkill')
            ->where('user_id', $id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();

        $labels = [];
        $sheets = [];

        foreach ($allSkills as $skill) {

            $labels[] = Carbon::parse($skill['created_at'])->format('Y M d');
            $key = $skill['a_skill']['skill_name'];

            $sheets[$key]['data'][] = $skill['level'];
            $sheets[$key]['label'] = $key;
            $sheets[$key]['borderColor'] = "red";
            $sheets[$key]['backgroundColor'] = "transparent";
        }

        $labels = array_values(array_unique($labels));
        $sheets = array_values($sheets);


        return view('users.details')
            ->with('user', $user)
            ->with('labels', $labels)
            ->with('sheets', $sheets);
    }

}