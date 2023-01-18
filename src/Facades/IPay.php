<?php

namespace Roksta\IPay\Facades;

use Illuminate\Support\Facades\Facade;

class IPay extends Facade
{
   protected static function getFacadeAccessor()
   {
      return 'ipay';
   }
}
