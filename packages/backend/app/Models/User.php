<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Set the user's login.
     * Ref: https://laravel.com/docs/8.x/eloquent-mutators
     *
     * @param  string  $value
     * @return void
     */
    public function setLoginAttribute($value)
    {
        $this->attributes['login'] = strtolower($value);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Checks permissions linked to roles with logged in user
     */
    public function hasPermission(Permission $permission)
    {
        // User permision_user => [menu_user_view, menu_post_show]
        $hasUserPermission = $this->hasAnyUserPermissions($permission);

        if($hasUserPermission) {
            return true;
        }

        // Roles user: role_user => [menu_user_view, menu_post_show]
        return $this->hasAnyRoles($permission->roles);
    }

    /**
     * Check if the logged in user has the specific permission
     * @return true or false
     */
    public function hasAnyRoles($roles)
    {
        // role_user => admin, manage  | (logged in user has the specified function)
        if( is_array($roles) || is_object($roles) ):
            return !! $roles->intersect($this->roles)->count();
        endif;

        return $this->roles->contains('name', $roles);
    }

    /**
     * Check if the logged in user has the specific permission
     * @return true or false
     */
    public function hasAnyUserPermissions($permission)
    {
        if(is_object($permission)):
            if(!empty($permission->name)) {
               return $this->permissions->contains('name', $permission->name);
            }
        endif;

        return false;
    }
}
