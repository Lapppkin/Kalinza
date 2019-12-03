<?php
namespace Sotbit\Regions\Seo;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
class AdminArea
{
	const START_SEO_BLOCK = "BX.adminShowMenu(this, [{'TEXT'";
	const END_SEO_BLOCK = ", '');";
	const INPUT_WRAPPER = 'insertIntoInheritedPropertiesTemplate';
	const INPUT_DELIMITER = ", \'";
	const INPUT_WRAPPER_END = ")'";
	public static function addRegionsSeo(&$content)
	{
		global $APPLICATION;
		$curPage = $APPLICATION->GetCurPage();
		if(
			Loader::includeModule('sotbit.regions') &&
			!\SotbitRegions::isDemoEnd()
            &&
			(
				$curPage == '/bitrix/admin/cat_product_edit.php' ||
				$curPage == '/bitrix/admin/cat_section_edit.php' ||
				$curPage == '/bitrix/admin/iblock_element_edit.php' ||
				$curPage == '/bitrix/admin/iblock_section_edit.php'
			)
		)
		{
			$tags = \SotbitRegions::getTags();

			$lastPos = 0;
			$i = 0;
			while (($lastPos = strpos($content, self::START_SEO_BLOCK, $lastPos))!== false)
			{
				$end = strpos($content,self::END_SEO_BLOCK,$lastPos);

				$startInputWrapper = strpos($content,self::INPUT_WRAPPER,$lastPos);
				$input1Start = strpos($content,self::INPUT_DELIMITER,$startInputWrapper);
				$input2Start = strpos($content,self::INPUT_DELIMITER,$input1Start +1);

				$input1 = substr(
					$content,
					$input1Start+strlen(self::INPUT_DELIMITER),
					$input2Start - $input1Start - 2 - strlen(self::INPUT_DELIMITER)
				);

				$input2End = strpos($content,self::INPUT_WRAPPER_END,$input2Start);

				$input2 = substr($content,$input2Start+4,$input2End - $input2Start-6);

				$str = ",\n{'TEXT':";
				$str .= "'".Loc::getMessage(\SotbitRegions::moduleId.'_SEO_PARENT')."'";
				$str .= ",'MENU':[";
				foreach($tags as $tag)
				{
					$str .= "{'TEXT':'".$tag['NAME']."','ONCLICK':'InheritedPropertiesTemplates.insertIntoInheritedPropertiesTemplate(\'".\SotbitRegions::genCodeVariable($tag['CODE'])."\', \'".$input1."\', \'".$input2."\')'},";
				}
				$str = substr($str,0,strlen($str) -1);
				$str .= ']}';

				$content = substr($content, 0, $end-1).$str.substr($content, $end-1);

				$lastPos = $lastPos + strlen(self::START_SEO_BLOCK);
				if($i > 30)
					break;
				++$i;
			}
		}
	}
}