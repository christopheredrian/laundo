<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     * Get role of user.
     *
     */
    public function getCompleteName()
    {
        $completeName = Auth::user()->first_name . " " . Auth::user()->last_name;

        return $completeName;
    }

    public function getRole()
    {
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', Auth::user()->id)
            ->get()
            ->first()
            ->type;

        return $userRole;
    }

    /**
     * Check if user has specified role
     * Shitty pa tong code na to pag bigyan niyo muna ako I am rusty sa Laravel
     *
     * @param $role Specified role
     */
    public function hasRole($role)
    {
        $userRole = $this->getRole();

        return $userRole == $role ? true : false; // If assigned role is the same as role expected, return true
    }
}