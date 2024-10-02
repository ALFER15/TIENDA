<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function suppliers(){
        return $this->belongsToMany(Supplier::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
