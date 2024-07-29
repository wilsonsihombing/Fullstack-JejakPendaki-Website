<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TransactionDetail extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'transactions_id',
        'username',
        'nationality',
        'is_band',
        'd_healt_letter',
    ];

    // protected $attributes = [
    //     'is_band' => false, // Default value untuk is_band
    // ];

    protected $hidden = [
        
    ];

    protected $dates = ['d_healt_letter', 'deleted_at', 'created_at', 'updated_at'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

 
}
