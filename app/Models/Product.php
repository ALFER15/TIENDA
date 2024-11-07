<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =['name','stock','store_price','public_price','expiration','assortment','status','supplier_id','category_id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function tickets(){
        return $this->belongsToMany(Ticket::class);
    }
    public function branches(){
        return $this->belongsToMany(Branch::class);
    }
}
