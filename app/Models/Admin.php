<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends  Authenticatable
{
    use   Notifiable;

    protected $gurds = 'admin';
    protected $fillable = [
        'name',
        'type',
        'mobile',
        'email',
        'password',
        'image',
        'status',
         'created_at',
         'updated_at',
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
}
