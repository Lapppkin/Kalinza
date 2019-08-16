<?
namespace Askaron\Geo;

class Info
{
	static private $ip = false;

	public static function setIp( $ip )
	{
		$ip = trim($ip);
		if ($ip == "")
		{
			$ip = false;
		}

		self::$ip = $ip;
	}

	public static function getIp()
	{
		if ( self::$ip == false )
		{
			$ip = \CAskaronGeo::getIp();

			self::$ip = $ip;
		}

		return self::$ip;
	}

	public static function getSxGeoCityFull()
	{
		$arResult = array();

		$ip = self::getIp();

		static $arCache = array();

		if ( isset( $arCache[ $ip ] ) )
		{
			$arResult = $arCache[ $ip ];
		}
		else
		{
			$arResult = \CAskaronGeo::getSxGeoCityFull($ip);

			$arCache[ $ip ] = $arResult;
		}

		return $arResult;
	}
}