<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingSource extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'funding_source';

    protected $fillable = [
        'user_id',
        'camp_id',
        'office_id',
        'transaction_no',
        'purpose_id',
        'financial_source',
        'fund_cluster',
        'fund_category',
        'fund_auth',
        'specific_fund',
        'reasons',
        'allotment',
        'account_code',
        'amount',
        'remember_token',
    ];
    // In Purpose model
    public function fundingSource() {
        return $this->hasOne(FundingSource::class, 'transaction_no');
    }

    // In FundingSource model
    public function purpose() {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }

}
