<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    public function sessions(){
        return $this->hasMany(Session::class, 'game_id', 'id');
    }
}
