<?php

namespace Musonza\Groups\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
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
