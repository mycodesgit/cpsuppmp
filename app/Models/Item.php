<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'item';

    protected $fillable = [
        'item_name',
        'item_descrip',
        'item_cost',
        'category_id',
        'unit_id',
        'remember_token',
    ];
}
