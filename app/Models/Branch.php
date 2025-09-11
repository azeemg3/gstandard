<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public static function dropdown($id=0){
        $res=self::where('id','!=',Auth::user()->branch_id)->get();
        $list='';
        foreach ($res as $item){
            $list.='<option '.($id==$item->id?'selected':'').' value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public static function branches($id=0){
        $res=self::all();
        $list='';
        foreach ($res as $item){
            $list.='<option '.($id==$item->id?'selected':'').' value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }

    public function company(){
        return $this->belongsTo(Company::class,'CID','id');
    }
    public function expenses(){
        return $this->hasMany(Expense::class,'branch_id','id');
    }
    public function staffSalaries(){
        return $this->hasMany(StaffSalary::class,'branch_id','id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'from_branch_id','id');
    }
}
