<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [''];

     protected $casts = [
        'sender_details' => 'array',
        'receiver_details' => 'array'
    ];

    public static function dropdown($id=0){
        $res=self::all();
        $list='';
        foreach ($res as $item){
            $list.='<option '.($id==$item->id?'selected':'').' value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public function receiver_branch(){
        return $this->belongsTo(Branch::class,'to_branch_id','id');
    }
    public function sender_branch(){
        return $this->belongsTo(Branch::class,'from_branch_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'CID','id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            // Only generate if not already provided
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = 'MTCN-' . date('Ymd') . '-' . uniqid();
            }
        });
    }
}
