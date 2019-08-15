<?
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
   if (defined('ERROR_404') && ERROR_404=='Y' && !defined('ADMIN_SECTION'))
   {
      GLOBAL $APPLICATION;
      global $USER;
      $APPLICATION->RestartBuffer();
    
      require $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.SITE_TEMPLATE_ID.'/header.php';
      require $_SERVER['DOCUMENT_ROOT'].'/404.php';
      require $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.SITE_TEMPLATE_ID.'/footer.php';
   }
}
?>