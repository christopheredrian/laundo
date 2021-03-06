<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

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
        'verified',
        'verification_token',
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
        'verification_token'
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
     * @var array
     */
    protected $dates = ['deleted_at'];

    ##################################################
    #           User Roles
    ##################################################

    const USER_ROLE_ADMIN = "admin";
    const USER_ROLE_EMPLOYEE = "employee";
    const USER_ROLE_BUSINESS_OWNER = "business_owner";
    const USER_ROLE_CUSTOMER = "customer";


    const VALID_USER_ROLES = [
        self::USER_ROLE_ADMIN,
        self::USER_ROLE_EMPLOYEE,
        self::USER_ROLE_BUSINESS_OWNER,
        self::USER_ROLE_CUSTOMER
    ];

    ##################################################
    #           End - User Roles
    ##################################################

    /**
     *
     */
    const VERIFIED_USER = "1";
    const UNVERIFIED_USER = "0";
    /**
     *
     */


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
        return $this->role;
    }

    /**
     * Check if user has specified role
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        $userRole = $this->getRole();

        return ($userRole == $role) ? true : false; // If assigned role is the same as role expected, return true
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified == User::VERIFIED_USER;

    }

    /**
     * @return bool|string
     */
    public static function generateVerificationCode(): string
    {
        /**
         * Generate a random 32 character string
         */
        return md5(microtime());
    }

    ################################################################################
    #                       Relationships
    ################################################################################


    /**
     * @param string $related
     * @param null $foreignKey
     * @param null $localKey
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function logs($related, $foreignKey = null, $localKey = null)
    {
        return $this->hasMany(Log::class);
    }

}