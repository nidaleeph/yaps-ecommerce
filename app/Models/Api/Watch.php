<?php

namespace App\Models\Api;

class Watch extends \App\Models\Watch
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
