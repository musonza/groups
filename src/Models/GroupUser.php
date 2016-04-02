<?php

namespace Musonza\Groups\Models;

use Eloquent;

class GroupUser extends Eloquent
{
    protected $table = 'group_user';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
