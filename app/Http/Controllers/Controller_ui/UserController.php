<?php

namespace App\Http\Controllers\Controller_ui;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Repository\IUserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;
use Auth;

class UserController extends Controller
{
    public $user;
    public function __construct(IUserRepository $user){
        $this->user = $user;
    }
    
    public function list(Request $request){
        
        if($request->keyword){
            $data=$this->user->getUser()->where('name','like','%'.$request->keyword.'%')->paginate(10);
        }else{
            $data=$this->user->getUser()->paginate(10);
        }
        return view('admin.user.list',compact('data'));
        
    }

    public function create(){
        $location=$this->user->getLocation();
        $roles=$this->user->getRole();

        return view('admin.user.add',compact('location','roles'));
    }

    public function store(UserRequest $request){
        $user=User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make('12345678'),
            'location_id'=> $request->location_id,
            'is_activated'=>1,
        ]);
        $user->roles()->sync($request->input('roles'));
        $pass = 12345678;
        $get_user_eamil = $request->email;
        $get_user_name = $user->name;
        Mail::to($request->email)->send(new ForgotMail($get_user_eamil, $get_user_name, $pass));
        return redirect('/admin/user/list')
            ->with('status', 'Đã thêm user thành công');

    }


    public function change(Request $request,$id){
        $user=$this->user->findUser( $id );
        if(hash::check($request->password,$user->password)){
            $data=$request->all();
            $this->user->changePass($id,$data);
            return redirect('login');
        }else{
            return view('admin.change_pass',compact('id'));
        }
        
    }
}
