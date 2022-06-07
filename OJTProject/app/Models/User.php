<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use softDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone',
        'address',
        'dob',
        'profile',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id'
    ];

    /**
     * the attribute that should be changed to dates
     * @var array
     */
    protected $date = ['deleted_at'];

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

    public function posts(){
        return $this->hasMany(Post::class , 'created_user_id');
    }
    
    public function createdUser(){
        return $this->belongsTo(User::class , 'created_user_id');
    }
}
