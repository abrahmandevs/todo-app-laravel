<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

	public function assigned_user(){
		return $this->belongsTo(User::class,'assigned_id');
	}
	public function updated_user(){
		return $this->belongsTo(User::class,'updated_id');
	}
}
