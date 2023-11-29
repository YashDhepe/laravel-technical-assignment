<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUserQuizResponse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function app_user(){
        return $this->belongsTo(AppUser::class);
    }
    
    public function quiz_details(){
        return $this->hasMany(AppUserQuizResponseDetail::class);
    }

    public function game(){
        return $this->belongsTo(Game::class);
    }
}
