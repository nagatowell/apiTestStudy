<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Sales extends Eloquent {

    protected $collection = 'sales';

}