<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => "Login Failed!"
            ]);
        } else {
            if (Auth::attempt($request->only(["email", "password"]))) {

                $data = User::where('email', $request['email'])->first();

                $request->session()->put([
                    'userid' => $data->user_id,
                    'name' => $data->name,
                    'email' => $data->email,
                    'profile' => $data->profile,
                    'updated_at' => $data->updated_at
                ]);

                session()->flash("message", "Welcome Back!");
                session()->flash("flash_name", $data->name);

                return response()->json(["status" => true, "redirect" => url("/note")]);
            } else {
                return response()->json(["status" => false, "errors" => "Login Failed!"]);
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $data = User::where('user_id', $request->user_id)->first();

        if ($data->updated_at == $request->updated_at) {
            return redirect('/');
        } else {
            return redirect('/')->with('message', 'User updated successfully');
        }
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

        $validator = Validator::make($request->all(), [
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:6'
        ]);

        if (!$validator->passes()) {

            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            $values = [
                'user_id' => rand(000000000, 999999999),
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ];

            User::create($values);

            session()->flash("message", "New user created successfully");

            return response()->json(['status' => true, 'redirect' => url("/")]);
        }
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
    public function update(Request $request)
    {
        if ($request->toggle == "checked") {
            //With Password
            $validator = Validator::make($request->all(), [
                "name" => ['required', 'min:4'],
                "email" => ['required', 'email'],
                "password" => 'required|confirmed|min:6'
            ]);
        } else {
            //No Password
            $validator = Validator::make($request->all(), [
                "name" => ['required', 'min:4'],
                "email" => ['required', 'email'],
            ]);
        }

        if (!$validator->passes()) {

            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            if ($request->hasFile('profile')) {

                $file = $request->file('profile');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('uploads/images/', $filename);

                if ($request->toggle == "checked") {
                    $values = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'profile' => $filename,
                        'password' => bcrypt($request->password)
                    ];
                } else {
                    $values = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'profile' => $filename,
                    ];
                }

                User::where('user_id', $request->user_id)->update($values);
                session()->flash("message", "User Updated Successfully!");

                return response()->json(["status" => true]);
            } else {

                if ($request->toggle == "checked") {
                    $values = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password)
                    ];
                } else {
                    $values = [
                        'name' => $request->name,
                        'email' => $request->email,
                    ];
                }

                User::where('user_id', $request->user_id)->update($values);
                session()->flash("message", "User Updated Successfully!");

                return response()->json(["status" => true]);
            }
        }
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
}
