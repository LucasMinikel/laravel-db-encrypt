<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\Crypter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $crypter;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->crypter = new Crypter();
    }

    public function setCpfAttribute($value)
    {
        if (!$this->crypter) {
            $this->crypter = new Crypter();
        }
        $this->attributes['cpf'] = $this->crypter->encrypt($value);
    }

    public function getCpfAttribute($value)
    {
        return $this->crypter->decrypt($value);
    }

    public function scopeWhereCpf($query, $cpf)
    {
        return $query->where('cpf', $this->crypter->encrypt($cpf));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
