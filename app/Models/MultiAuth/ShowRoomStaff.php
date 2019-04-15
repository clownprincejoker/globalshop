<?php

namespace App\Models\MultiAuth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword\ShowRoomStaffResetPasswordNotification;

use App\Models\Other\Image;
use App\Models\Other\Address;
use App\Models\Other\PhoneNumber;
use App\Models\Other\Role;
use App\Models\Purchase\ShowRoom;

class ShowRoomStaff extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ShowRoomStaffResetPasswordNotification($token));
    }

    //getters
    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getProfilePic(){
      if(Image::find($this->profile_pic)){
        return (Image::find($this->profile_pic))->uri;
      }
      else{
        return 'storage/images/temp.png';
      }
    }

    public function getAddress(){
        return Address::find($this->address_id);
    }

    public function getPhoneNumber(){
        return PhoneNumber::find($this->phone_number_id);
    }

    public function getShowRoom(){
        return ShowRoom::find($this->showroom_id);
    }

    public function getRole(){
        return Role::find($this->role_id);
    }
}
