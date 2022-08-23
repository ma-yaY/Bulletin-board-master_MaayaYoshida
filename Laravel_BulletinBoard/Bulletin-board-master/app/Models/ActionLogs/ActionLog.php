<?php

namespace App\Models\ActionLogs;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Http\Controllers\User\UserController;


class ActionLog extends Model
{
    protected $table = 'action_logs';

    protected $fillable = [
        'user_id',
        'post_id',
        'event_at',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    // PostModelsとのリレーション
    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }


}
