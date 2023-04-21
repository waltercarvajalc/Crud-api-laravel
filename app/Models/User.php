<?php

namespace App\Models;

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
        'name',
        'email',
        'password',
        'role'
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

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_AUTHOR = 'ROLE_AUTHOR';
    const ROLE_READER = 'ROLE_READER';

//    private const ROLES_HIERARCHY = [
    //        self::ROLE_ADMIN => [self::ROLE_AUTHOR, self::ROLE_READER],
    //        self::ROLE_AUTHOR => [self::ROLE_READER],
    //       self::ROLE_READER => []
    //   ];

    private const ROLES_HIERARCHY = [
        self::ROLE_ADMIN => [self::ROLE_AUTHOR],
        self::ROLE_AUTHOR => [self::ROLE_READER],
        self::ROLE_READER => [],
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //relacion de uno a muchos user-posts

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        
        return $this->belongsToMany(Category::class);
    }

    public function isGranted($role)
    {
        if ($role === $this->role) {
            return true;
        }
        return self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$this->role]);
    }

    private static function isRoleInHierarchy($role, $role_hierarchy)
    {
        if (in_array($role, $role_hierarchy)) {
            return true;
        }
        foreach ($role_hierarchy as $role_included) {
            if (self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$role_included])) {
                return true;
            }
        }
        return false;
    }
}
