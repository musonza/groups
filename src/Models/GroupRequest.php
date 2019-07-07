<?php

namespace Musonza\Groups\Models;

use Illuminate\Database\Eloquent\Model;

class GroupRequest extends Model
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
