<?php

namespace Musonza\Groups\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model
{
    protected $table = 'group_post';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
