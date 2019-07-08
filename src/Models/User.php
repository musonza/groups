<?php

namespace Musonza\Groups\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Musonza\Groups\Traits\GroupHelpers;

class User extends Authenticatable
{
    use GroupHelpers;
}
