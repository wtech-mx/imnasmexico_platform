<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

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
        'habilitar_btn',
        'clave_clasificacion',
        'idocurp',
        'nomina_estatus',
        'fecha_ingreso',
        'seguro_estatus',
        'sueldo',
        'banco',
        'tipo_cuenta',
        'numero_cuenta',
        'clave_stp',
    ];

    public function RegistroImnasEscuela()
    {
       return $this->hasOne(RegistroImnasEscuela::class,'id_user');
    }

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

        public function getYearsOfServiceAttribute(): int
    {
        return Carbon::parse($this->fecha_ingreso)
                     ->diffInYears(now());
    }

    /**
     * Obtiene los días de vacaciones según la ley.
     */
    public function getVacationDaysAttribute(): int
    {
        $years = $this->years_of_service;

        if ($years < 1) {
            // Si aún no cumple el primer año podrías devolver 0
            return 0;
        }

        switch ($years) {
            case 1:
                return 12;
            case 2:
                return 14;
            case 3:
                return 16;
            case 4:
                return 18;
            default:
                // A partir del 5º año: 20 días,
                // y +2 días por cada bloque de 5 años extra
                $base       = 20;
                $extraYears = $years - 5;
                $blocks     = floor($extraYears / 5);
                return $base + ($blocks * 2);
        }
    }
    public function avisos()
    {
        return $this->belongsToMany(
            NominaTareas::class,     // modelo relacionado
            'nomina_tareas_asignaciones',     // tabla pivote
            'id_users',        // FK en pivote que apunta a este User
            'id_tareas'        // FK en pivote que apunta a Aviso
        )->withPivot('visto_en','clic_en')
        ->withTimestamps();
    }
}
