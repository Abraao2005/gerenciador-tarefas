<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use PDOException;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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

    public function insertUser($name, $password, $email)
    {
        try {
            DB::insert("INSERT INTO users (name,email,password)  VALUES (? , ? ,?)", [$name, $email, $password]);
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage());
        }
    }
    public function selectUser($email)
    {
        try {
            return DB::select("SELECT * from users WHERE email = ? LIMIT 1", [$email])[0];
        } catch (PDOException $exp) {
            throw new Exception($exp->getMessage(), 1);
        }
    }
}
