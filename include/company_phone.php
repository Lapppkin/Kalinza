<?php

use core\Helper;
use core\Regionality;

$phone = Regionality::getCurrentRegionPhoneMain();
if (empty($phone)) $phone = '8 800 301-21-01';

print Helper::parsePhone($phone, 'link');
