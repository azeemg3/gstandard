<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StaffSalary extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public static function dropdown($id = null)
    {
        $res = self::all();
        $list = '';
        foreach ($res as $item) {
            $list .= '<option ' . ($id == $item->id ? 'selected' : '') . ' value="' . $item->id . '">' . $item->name . '</option>';
        }
        return $list;
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
    public function staff(){
        return $this->belongsTo(User::class,'staff_id','id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($SourceQuery) {
            if (auth()->check()) {
                $SourceQuery->created_by = Auth::user()->id;
            }
        });
    }
}
