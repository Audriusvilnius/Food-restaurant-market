<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC');
        if (Auth::user()->role != 'admin') {
            $data = $data->where('id', Auth::user()->id)->paginate(5);
        } else {
            $data = $data->where('id', Auth::user()->id);
        }
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $rest_id = Restaurant::all();
        $cites = City::all();
        return view('users.create', [
            'rest_id' => $rest_id,
            'cites' => $cites,
            'roles' => $roles,
        ]);
        // return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'rest_id' => 'required',
            'city_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $user->role = $request->roles[0];
        $user->rest_id = $request->rest_id;
        $user->city_id = $request->city_id;
        $user->phone = $request->phone;
        $user->street = $request->street;
        $user->build = $request->build;
        $user->postcode = $request->postcode;
        $user->save();

        Session::put('citySelect', []);
        Session::put('citySelect', Auth::user()->city_id);

        return redirect()->route('users.index')
            ->with('ok', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $rest_id = Restaurant::all();
        $cites = City::all();
        return view('users.edit', [
            'rest_id' => $rest_id,
            'user' => $user,
            'cites' => $cites,
            'roles' => $roles,
            'userRole' => $userRole
        ]);

        // return view('back.food.index', [
        //     'foods' => $foods,
        //     'cities' => $cities,
        //     'categories' => $categories,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 'admin') {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
                'street' => 'required',
                'build' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',
            ]);
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        if (Auth::user()->role == 'admin') {
            $user->role = $request->roles[0];
            $user->assignRole($request->input('roles'));
        } else {
            // $user->role = $request->role;
            $user->assignRole($request->role);
        }
        $user->rest_id = $request->rest_id;
        $user->city_id = $request->city_id;
        $user->phone = $request->phone;
        $user->street = $request->street;
        $user->build = $request->build;
        $user->postcode = $request->postcode;
        $user->save();

        Session::put('citySelect', []);
        Session::put('citySelect', Auth::user()->city_id);

        return redirect()->route('users.index')
            ->with('ok', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('ok', 'User deleted successfully');
    }
}
