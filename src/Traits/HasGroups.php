<?php

namespace Musonza\Groups\Traits;

use Musonza\Groups\Models\Group;

trait HasGroups
{
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }
}