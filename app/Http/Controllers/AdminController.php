<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login()
    {
        return view('admin.login');
    }

    public function post_login(Request  $request)
    {
        $request->validate(
            [
            'email' =>'required|email|exists:users',
            'password' =>'required',
            ],
        );
        $data = $request->only('email','password');
        $check_login = Auth::guard('')->attempt($data, $request->has('remember'));// remember->chọn checkbox thì là true
        if($check_login){
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error','Mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::guard('')->logout();

        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.profile');
    }
}