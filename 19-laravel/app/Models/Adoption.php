<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    /**
     * Summary of fillable
     * @var array
     */ 
    protected $fillable = [
        'user_id',
        'pet_id',
    ];

    //RelationShip
    //Adoption belong to User 
    public function user() {
        return $this->belongsTo(User::class);
    }
    //Adoption belong to Pet
    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    // Search By Scope
    public function scopenames($query, $q) {
        if(trim($q)) {
            $query->whereHas('user', function($query) use ($q) {
                $query->where('fullname', 'LIKE', "%$q%");
            })->orWhereHas('pet', function($query) use ($q) {
                $query->where('name', 'LIKE', "%$q%");
            });
        }
    }
}
