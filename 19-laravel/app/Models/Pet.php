<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{

    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'image',
        'kind',
        'weight',
        'age',
        'bread',
        'location',
        'description',
        'active',
        'adopted'
    ];

    //RelationShip:
    //Pet has one Adoptions 
    public function adoptions() {
        return $this->hasOne(Adoption::class);
    }

    // Search By Scope
    public function scopenames($pets, $q) {
        if(trim($q)) {
            $pets->where('name', 'LIKE', "%$q%")->orWhere('kind', 'LIKE', "%$q%");
        }
    }
}