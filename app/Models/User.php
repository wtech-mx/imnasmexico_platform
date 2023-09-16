<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
   use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'photo',
        'telefono',
        'cliente',
        'password',
        'puesto',
        'username',
        'code',
        'direccion',
        'num_user',
        'otra_red',
        'pagina_web',
        'colonia',
    ];

    public function DocumentosEstandares()
    {
       return $this->hasMany(DocumentosEstandares::class,'id_usuario');
    }

    public function Documentos()
    {
       return $this->hasOne(Documentos::class,'id_usuario');
    }

    public function Orders()
    {
        return $this->hasMany(Orders::class, 'id_usuario');
    }

    public function Factura()
    {
        return $this->hasOne(Factura::class, 'id_usuario');
    }

    public function EnviosOrder()
    {
        return $this->hasOne(EnviosOrder::class, 'id_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
