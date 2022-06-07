<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Contract\Service\User\UserServiceInterface;

class UserController extends Controller
{
    private $userService;

    /**
     * 
     */
    public function __construct(UserServiceInterface $user_service_interface)
    {
        $this->userService = $user_service_interface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUserList();
        return view('user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateUser('required',null);
        $image = $request->profile;
        $imageName = uniqid(). '_' . $image->getClientOriginalName();
        $image->storeAs('public/profile-images', $imageName);
        $data['profile'] = $imageName;
        $request->session()->put('users', $data);
        return redirect('/users/create/collectdataform');
    }

    public function collectDataForm()
    {
        return view('user.create-confirm');
    }

    /**
     * store collect data
     * @param \Illuminate\Http\Request
     */
    public function storeCollectData(Request $request)
    {
        $this->userService->storeCollectData($request->all());
        return redirect('/users')->with('successAlert' , 'User has created successfully');
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
        $this->userService->deleteUser($id);
        return redirect('/users')->with('successAlert' , 'User has deleted successfully.');
    }

    /**
     * @param $rule
     * @param $id
     */
    private function validateUser($rule, $id)
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,' . $id,
            'password' => $rule . '|min:8|regex:/^(?:(?=.*\d)(?=.*[A-Z]).*)$/',
            'password_confirmation' => $rule . '|same:password',
            'type' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'dob' => 'nullable',
            'profile' => $rule,
        ]);
    }
}
