<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Contract\Service\User\UserServiceInterface;
use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Validator;
//use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $userService;

    /**
     * 
     */
    public function __construct(UserServiceInterface $user_service_interface)
    {
        $this->middleware(['isadmin'])->only('index');
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
        $data = $this->validateUser('required' , null);
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
        $users = $this->userService->findUserById($id);
        return view('user.edit')->with('users' , $users);
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
        $user = User::find($id);
        $update_data = $this->validateUser('nullable' , $id);
        $update_data['id'] = $id;
        if($request->profile)
        {
            $old_img = $user->profile;
            File::delete('public/profile-images/'.$old_img);
            $image = $request->profile;
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/profile-images', $imageName);
            $update_data['profile'] = $imageName;
        }
        else
        {
            $update_data['profile'] = $user->profile;
        }
        $request->session()->put('users' , $update_data);
        return redirect('users/update/collectData');
    }

    /**
     * collect data for update confirm
     */
    public function collectData()
    {
        return view('user.update-confirm');
    }

    public function updateUser(Request $request,$id)
    {
        $this->userService->updateUser($request->all(),$id);
        return redirect('/posts')->with('successAlert' , 'User has updated successcully.');
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
     * search user 
     *  @param  \Illuminate\Http\Request  $request
     */
    public function search(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $users =  $this->userService->search($name,$email,$start_date,$end_date);
        return view('user.list' , compact('users','name','email','start_date','end_date'));
    }

    /**
     * user profile
     * @param $id
     */
    public function userProfile($id)
    {
        $user = $this->userService->userProfile($id);
        return view('user.userProfile')->with('user' , $user);
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
