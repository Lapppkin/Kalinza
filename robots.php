<?php

use Bitrix\Main\Loader;
require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

//if (!Loader::includeModule("sotbit.regions")) return false;

//$domain = new \Sotbit\Regions\Location\Domain();
//$domainCode = $domain->getProp("CODE");
$domainCode = $_SERVER['SERVER_NAME'];
?>

User-Agent: *
Disallow: /

Disallow: /1
Disallow: /*?*
Disallow: /*index.php$
Disallow: /auth/
Disallow: /personal/
Disallow: /search/
Disallow: /*/search/
Disallow: /*/slide_show/
Disallow: /*/gallery/*order=*
Disallow: /*&print=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*action=*
Disallow: /*backurl=*
Disallow: /*BACKURL=*
Disallow: /*back_url=*
Disallow: /*BACK_URL=*
Disallow: /*back_url_admin=*
Disallow: /*print_course=Y
Disallow: /*COURSE_ID=
Disallow: /*SHOWALL
Disallow: /*show_all=

User-Agent: Yandex
Disallow: /1
Disallow: /*?*
Disallow: /*index.php$
Disallow: /auth/
Disallow: /personal/
Disallow: /search/
Disallow: /*/search/
Disallow: /*/slide_show/
Disallow: /*/gallery/*order=*
Disallow: /*&print=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*action=*
Disallow: /*backurl=*
Disallow: /*BACKURL=*
Disallow: /*back_url=*
Disallow: /*BACK_URL=*
Disallow: /*back_url_admin=*
Disallow: /*print_course=Y
Disallow: /*COURSE_ID=
Disallow: /*SHOWALL
Disallow: /*show_all=

User-Agent: Googlebot
Disallow: /1
Disallow: /*?*
Disallow: /*index.php$
Disallow: /auth/
Disallow: /personal/
Disallow: /search/
Disallow: /*/search/
Disallow: /*/slide_show/
Disallow: /*/gallery/*order=*
Disallow: /*&print=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*action=*
Disallow: /*backurl=*
Disallow: /*BACKURL=*
Disallow: /*back_url=*
Disallow: /*BACK_URL=*
Disallow: /*back_url_admin=*
Disallow: /*print_course=Y
Disallow: /*COURSE_ID=
Disallow: /*SHOWALL
Disallow: /*show_all=

Host: <?= $domainCode ?>

Sitemap: https://<?= $domainCode ?>/sitemap.xml
