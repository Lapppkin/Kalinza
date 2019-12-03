<?php

use core\Helper;
use core\Regionality;

$phone = Regionality::getCurrentRegionPhoneMain();

print Helper::parsePhone($phone, 'link');
