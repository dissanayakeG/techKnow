<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Post extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $table = 'posts';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'post_content', 'tags', 'topic', 'likes', 'dislikes'
    ];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function reaction(){
        return $this->hasMany('App\UserReaction', 'post_id', 'id');
    }
}
