<?php

namespace Musonza\Groups\Models;

use Eloquent;

class Report extends Eloquent
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_reports';
    
    protected $fillable = ['user_id'];
}
