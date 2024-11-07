<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
