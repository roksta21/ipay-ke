<?php

namespace Roksta\IPay;

use Illuminate\Support\Facades\Facade;

class IPay extends Facade
{
   protected static function getFacadeAccessor()
   {
      return 'ipay';
   }
}
