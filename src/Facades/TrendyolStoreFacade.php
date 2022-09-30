<?php

namespace efast\TrendyolStoreApi\Facades;

use Illuminate\Support\Facades\Facade;

class TrendyolStoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'trendyolstore';
    }
}
