<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'purpose';

    protected $fillable = [
        'user_id',
        'office_id',
        'transaction_no',
        'purpose_name',
        'pstatus',
        'remember_token',
    ];
}
