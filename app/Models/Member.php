<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Reservation;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'role', 'member_id', 'profile_picture', 'password',
        'student_id', 'department', 'course', 'year_level', 'address', 'date_registered', 'is_active', 'last_login'
    ];
    
    // Define role constants
    const ROLE_LIBRARIAN = 'librarian';
    const ROLE_CHAIRPERSON = 'chairperson';
    const ROLE_PROFESSOR = 'professor';
    
    // Check if member is a librarian
    public function isLibrarian()
    {
        return $this->role === self::ROLE_LIBRARIAN;
    }
    
    // Check if member is a chairperson
    public function isChairperson()
    {
        return $this->role === self::ROLE_CHAIRPERSON;
    }
    
    // Check if member is a professor
    public function isProfessor()
    {
        return $this->role === self::ROLE_PROFESSOR;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}