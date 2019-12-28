<?php

namespace MyMenuGate;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && !Auth::user()->hasPermissionTo($item['permission'])) {
            return false;
        }

        return $item;
    }
}
