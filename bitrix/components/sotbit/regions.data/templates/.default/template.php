<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$frame = $this->createFrame()->begin("");
if($arResult['FIELDS']):
	?>
	<ul>
		<?foreach($arResult['FIELDS'] as $key => $field):?>
			<li>
				<?=$field['NAME']?>: <?=(is_array($field['VALUE']))?implode(', ',$field['VALUE']):$field['VALUE']?>
			</li>
		<?endforeach;?>
	</ul>
	<?
endif;
?>