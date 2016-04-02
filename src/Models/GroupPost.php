<?php

namespace Musonza\Groups\Models;

use Eloquent;

class GroupPost extends Eloquent
{
    protected $table = 'group_post';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
