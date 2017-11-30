<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Email extends Eloquent {

    protected $collection = 'email';

}