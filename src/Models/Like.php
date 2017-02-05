<?php

namespace Musonza\Groups\Models;

use Eloquent;

class Like extends Eloquent
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_likes';
    
    protected $fillable = ['user_id'];
}
