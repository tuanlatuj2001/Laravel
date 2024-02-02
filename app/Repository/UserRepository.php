<?php

namespace App\Repository;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;

class UserRepository implements IUserRepository{

    public function getUser(){
        return User::join('locations', 'locations.id', '=', 'users.location_id')
        ->select('locations.location_name','users.*');
    }

    public function getLocation(){
        return Location::all();
    }

    public function getRole(){
        return Role::all();
    }
    
    public function findUser($id){
        return User::find($id);
    }
    public function changePass($id ,array $data){
        User::find($id)->update([
            'password'=> Hash::make($data['new_password'])
        ]);
    }
}

