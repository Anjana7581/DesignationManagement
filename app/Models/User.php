<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

   
    
        protected $fillable = [
            'name', 'email', 'password','is_admin','contact_number', 'alt_contact_number', 'address', 'designation_id', 'status'
        ];
    
       

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'is_admin' => 'boolean', // Ensure it's casted as a boolean

        ];
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function isAdmin()
{
    return $this->is_admin; // Returns true if the user is an admin
}
}
