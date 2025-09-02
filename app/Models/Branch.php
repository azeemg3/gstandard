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

    public function company(){
        return $this->belongsTo(Company::class,'CID','id');
    }
}
