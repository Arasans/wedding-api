<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginAdminController extends Controller
{
    public function index()
    {
        $data = Admin::all();
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
        $data = Admin::create($data);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $cek = Admin::find($admin->id);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $cek = Admin::find($admin->id);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        Admin::destroy($admin->id);
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
        $user = Admin::where('username', '=', $data['username'])->first();

        $data['password'] = Hash::check($data['password'], $user->password);

        if ($data['password']) {
            $response = [
                "success" => True,
                "message" => "Berhasil",
                "role" => "Admin"
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
