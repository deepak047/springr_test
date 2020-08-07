<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getExperienceAttribute()
    {
        $date_joining = Carbon::parse($this->date_of_joining );
        if($this->date_of_leaving){
            $date_leaving = Carbon::parse($this->date_of_leaving );
            $diff = $date_joining->diffInMonths($date_leaving);

        }else{
            $now = Carbon::now();
            $diff = $date_joining->diffInMonths($now);

        }
        
        

      
        return $diff;
    }
}
