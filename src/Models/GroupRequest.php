<?php

namespace Musonza\Groups\Models;

use Illuminate\Database\Eloquent\Model;
use Musonza\Groups\Groups;

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
        return $this->belongsTo(Groups::userModel(), 'user_id');
    }
}
