<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Controller;



class loginUserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return $this->sendResponse($data, 'Succeed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            "username" => $request->get("username"),
            "password" => $request->get("password")
        ];
        $data['password'] = Hash::make($data['password']);
        $data = User::create($data);
        if ($data) {
            $response = [
                "success" => True,
                "message" => "Created"
            ];
        } else {
            $response = [
                "success" => False,
                "message" => "Fail",

            ];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $cek = User::find($user->id);
        if ($cek) {
            return $this->sendResponse($cek, 'Successed');
        }
        $response = [
            "success" => false,
            "message" => "Not Found"
        ];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $cek = User::find($user->id);
        $cek->update($request->all());
        $response = [
            "success" => true,
            "message" => "Updated"
        ];
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        $response = [
            "success" => true,
            "message" => "Deleted"
        ];
        return $response;
    }

    public function login(Request $request)
    {
        $username = $request->get('username');
        $data = [

            'username' => $username,
            'password' => $request->get("password"),
        ];
        $user = User::where('username', '=', $data['username'])->first();

        $data['password'] = Hash::check($data['password'], $user->password);

        if ($data['password']) {
            $response = [
                "success" => True,
                "message" => "Berhasil",
                "role" => "User"
            ];
        } else {
            $response = [
                "success" => False,
                "message" => "Gagal"
            ];
        }
        return $response;
    }
}
