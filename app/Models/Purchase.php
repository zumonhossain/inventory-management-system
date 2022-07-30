<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model{
    use HasFactory;

    protected $guarded =[];

    public function supplier(){
        return $this->hasOne('App\Models\Supplier','supplier_id','supplier_id');
    }

    public function unit(){
        return $this->hasOne('App\Models\Unit','unit_id','unit_id');
    }

    public function category(){
        return $this->hasOne('App\Models\Category','category_id','category_id');
    }

    public function product(){
        return $this->hasOne('App\Models\Product','product_id','product_id');
    }
    
}
