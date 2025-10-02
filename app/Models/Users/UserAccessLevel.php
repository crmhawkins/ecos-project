<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserAccessLevel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admin_user_access_level';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    const FULL_ADMINISTRATOR = 1;
    const ACCESS_LEVEL_GERENTE = 2;
    const ACCESS_LEVEL_CONTABLE = 3;
    const ACCESS_LEVEL_GESTOR = 4;
    const ACCESS_LEVEL_PERSONAL = 5;
    const ACCESS_LEVEL_COMERCIAL = 6;
    const ACCESS_LEVEL_MARKETING = 7;
    const ACCESS_LEVEL_SOPORTE = 8;
    const ACCESS_LEVEL_RECURSOS_HUMANOS = 9;
    const ACCESS_LEVEL_SOLO_LECTURA = 10;
}
