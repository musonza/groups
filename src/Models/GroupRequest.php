<?php

namespace Musonza\Groups\Models;

use Eloquent;

class GroupRequest extends Eloquent
{
    protected $table = 'group_request';

    protected $fillable = ['user_id', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
