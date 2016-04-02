<?php

namespace Musonza\Groups\Traits;

use Musonza\Groups\Models\Report;

trait Reporting
{
    public function report($user_id)
    {
        $report = new Report(['user_id' => $user_id]);

        $this->reports()->save($report);
    }

    public function removeReport($user_id)
    {
        $this->reports()->where('user_id', $user_id)->delete();
    }

    public function toggleReport($user_id)
    {
        if ($this->isReported($user_id)) {
            return $this->removeReport($user_id);
        }

        $this->report($user_id);
    }

    public function isReported($user_id)
    {
        return !!$this->reports()
            ->where('user_id', $user_id)
            ->count();
    }

    public function getreportsCountAttribute()
    {
        return $this->reports()->count();
    }
}
