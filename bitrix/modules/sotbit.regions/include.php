<?
use Bitrix\Main\SystemException,
	Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc;

/**
 * Class SotbitRegions
 * @author Sergey Danilkin <s.danilkin@sotbit.ru>
 */
class SotbitRegions
{
	const moduleId = 'sotbit.regions';
	const regionsPath = 'sotbit_regions.php';
	const regionPath = 'sotbit_regions_edit.php';
	const settingsPath = 'sotbit_regions_settings.php';
	const sitemapPath = 'sotbit_regions_seofiles.php';
	const mask = '#SOTBIT_REGIONS_#CODE##';

	/**
	 * @var
	 */
	static private $demo = null;


	/**
	 *
	 */
	private static function setDemo()
	{
		self::$demo = \Bitrix\Main\Loader::includeSharewareModule( self::moduleId );
	}

	/**
	 * @return bool
	 */
	public static function isDemoEnd()
	{
		if(is_null(self::$demo))
		{
			self::setDemo();
		}
		if(self::$demo == 0 || self::$demo == 3)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * @return int
	 */
	public static function getDemo()
	{
		if(is_null(self::$demo))
		{
			self::setDemo();
		}
		return self::$demo;
	}

	/**
	 * @return array
	 */
	public static function getSites()
	{
		$sites = array();
		try
		{
			$rsSites = \Bitrix\Main\SiteTable::getList(array(
				'select' => array(
					'SITE_NAME',
					'LID'
				),
				'filter' => array('ACTIVE' => 'Y'),
			));
			while ($site = $rsSites->fetch())
			{
				$sites[$site['LID']] = $site['SITE_NAME'];
			}
			if(!is_array($sites) || count($sites) == 0)
			{
				throw new SystemException("Cannt get sites");
			}
		}
		catch (SystemException $exception)
		{
			echo $exception->getMessage();
		}
		return $sites;
	}

	/**
	 * @param string $parent
	 * @return string
	 * @throws \Bitrix\Main\LoaderException
	 */
	public static function getMenuParent($parent = '')
	{
		try
		{
			if(Loader::includeModule('sotbit.missshop'))
			{
				$parent = 'global_menu_missshop';
			}
			if(Loader::includeModule('sotbit.mistershop'))
			{
				$parent = 'global_menu_mistershop';
			}
			if(Loader::includeModule('sotbit.b2bshop'))
			{
				$parent = 'global_menu_b2bshop';
			}
			if(Loader::includeModule('sotbit.origami'))
			{
				$parent = 'global_menu_sotbit';
			}
			if(!$parent || !is_string($parent))
			{
				throw new SystemException("Cannt find menu parent");
			}
			return $parent;
		}
		catch (SystemException $exception)
		{
			echo $exception->getMessage();
		}
	}

	/**\
	 * @param string $code
	 * @return string
	 */
	public static function genCodeVariable($code = '')
	{
		try
		{
			if(!$code || !is_string($code))
			{
				throw new SystemException("Code isnt string");
			}
			return str_replace('#CODE#',$code,self::mask);
		}
		catch (SystemException $exception)
		{
			echo $exception->getMessage();
		}
	}
	public static function getTags($sites = array())
	{
		$return = array();
		if(!$sites)
		{
			$sites = array_keys(self::getSites());
		}
		$return[0] = array('CODE' => 'CODE', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_CODE'));
		$return[1] = array('CODE' => 'NAME', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_NAME'));
		$return[2] = array('CODE' => 'SORT', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_SORT'));
		$return[3] = array('CODE' => 'PRICE_CODE', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_PRICE_CODE'));
		$return[4] = array('CODE' => 'STORE', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_STORE'));
		$return[5] = array('CODE' => 'COUNTER', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_COUNTER'));
		$return[6] = array('CODE' => 'MAP_YANDEX', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_MAP_YANDEX'));
		$return[7] = array('CODE' => 'MAP_GOOGLE', 'NAME' => Loc::getMessage(\SotbitRegions::moduleId.'_MAP_GOOGLE'));
		$i = 8;
		foreach($sites as $site)
		{
			$rsData = \CUserTypeEntity::GetList(
				array($by=>$order),
				array( 'ENTITY_ID' => 'SOTBIT_REGIONS' )
			);
			while($userField = $rsData->Fetch())
			{
				$userField = \CUserTypeEntity::GetByID($userField['ID']); //need for lang
				$return[$i] = array(
					'CODE' => $userField['FIELD_NAME'],
					'NAME' => $userField['LIST_COLUMN_LABEL'][LANGUAGE_ID]);
				++$i;
			}
		}
		return $return;
	}
}
?>