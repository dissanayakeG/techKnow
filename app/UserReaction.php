<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReaction extends Model
{
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $table = 'user_reactions';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'post_id', 'reaction'
    ];


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function post(){
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
