<?php
namespace Askaron\Geo;

//use Bitrix\Main\Localization\Loc;
//Messages(__FILE__);

class Location
{
	//static private $arLocation = false;

	static private $cookie_location_id = false;

	public static function getLocation( $site_id = SITE_ID )
	{
		$arResult = null;

		if ( !is_array($_SESSION["ASKARON_GEO_LOCATION"][$site_id] ) )
		{
			self::setLocation($site_id);
		}

		$arResult = $_SESSION["ASKARON_GEO_LOCATION"][$site_id];

		return $arResult;
	}

	public static function setLocation($site_id = SITE_ID)
	{
		$result = false;

		// by session
		if ( is_array($_SESSION["ASKARON_GEO_LOCATION"][$site_id]) )
		{
			$result = true;
		}

		// by cookie
		if ( !$result && self::get_cookie_id() )
		{
			$result = self::setLocationById( self::get_cookie_id(), $site_id );
		}

		// by IP
		if ( !$result )
		{
			$result = self::setLocationByIp( $site_id );
		}

		//by  default
		if (!$result)
		{
			$default_location_id = \COption::GetOptionString("askaron.geo", "default_location_id", "", $site_id);

			if (
				\COption::GetOptionString("askaron.geo", "set_default_location_id", "Y", $site_id) == "Y"
				&&
				$default_location_id > 0
			)
			{
				$result = self::setLocationById( $default_location_id, $site_id );
			}
		}

		// set empty array if not found
		if ( !$result )
		{
			$_SESSION["ASKARON_GEO_LOCATION"][$site_id] = array();
		}

		return $result;
	}

	private static function set_cookie_id( $value )
	{
		global $APPLICATION;

		$APPLICATION->set_cookie( "ASKARON_GEO_LOCATION_ID", $value, time()+60*60*24*365, "/" );

		//$APPLICATION->set_cookie( "ASKARON_GEO_LOCATION_ID", "", time()-1, "/" );

		self::$cookie_location_id = $value;
	}

	private static function get_cookie_id()
	{
		global $APPLICATION;

		if ( self::$cookie_location_id === false )
		{
			self::$cookie_location_id = ''.$APPLICATION->get_cookie( "ASKARON_GEO_LOCATION_ID" );
		}

		return self::$cookie_location_id;
	}

	public static function clearCache()
	{
		self::set_cookie_id( "" );
		unset( $_SESSION["ASKARON_GEO_LOCATION"] );
	}

	static public function setLocationById( $id, $site_id = SITE_ID )
	{
		$result = false;

		if ( $id > 0 )
		{
			if(\Bitrix\Main\Loader::includeModule("sale"))
			{
				$parameters = array();
				$parameters['filter']["ID"] = $id;
				//$parameters['filter']['=TYPE.CODE'] = "CITY"; // version 1.1.0 may be VILLAGE
				$parameters['filter']['=NAME.LANGUAGE_ID'] = "ru";

				$parameters['limit'] = 1;
				$parameters['select'] = array(
					0 => "*",
					"NAME_RU" => "NAME.NAME",
					"TYPE_CODE" => "TYPE.CODE",
				);

				$arVal = \Bitrix\Sale\Location\LocationTable::getList($parameters)->fetch();

				if ($arVal)
				{
					$arResult = array(
						"ID" => $arVal["ID"],
						"CODE" => $arVal["CODE"],
						"NAME_RU" => $arVal["NAME_RU"],
						"PARENT_ID" => $arVal["PARENT_ID"],
						"COUNTRY_ID" => $arVal["COUNTRY_ID"],
						"REGION_ID" => $arVal["REGION_ID"],
					);

					$_SESSION["ASKARON_GEO_LOCATION"][ $site_id ] = $arResult;
					self::set_cookie_id($arResult["ID"]);

					$result = true;
				}
			}
		}

		return $result;
	}

	public static function setLocationByIp( $site_id = SITE_ID )
	{
		$result = false;

		if(\Bitrix\Main\Loader::includeModule("sale"))
		{
			$arFilter = array();

			$arCity = Info::getSxGeoCityFull();
			if ($arCity)
			{
				$city_name_ru = $arCity["city"]["name_ru"];
				if ( strlen( $city_name_ru ) > 0 )
				{
					$arFilter['=NAME.NAME'] = $city_name_ru;
				}
			}

			if ( $arFilter )
			{
				$parameters = array();
				$parameters['filter']= $arFilter;
				$parameters['filter']['=TYPE.CODE'] = "CITY";
				$parameters['filter']['=NAME.LANGUAGE_ID'] = "ru";

				$parameters['limit'] = 1;
				$parameters['select'] = array(
					0 => "ID",
					"NAME_RU" => "NAME.NAME",
					"TYPE_CODE" => "TYPE.CODE"
				);

				$arVal = \Bitrix\Sale\Location\LocationTable::getList($parameters)->fetch();

				if ($arVal)
				{
					$result = self::setLocationById( $arVal["ID"], $site_id );
				}
			}
		}

		return $result;
	}


	// new
	public static function OnSaleComponentOrderProperties( &$arUserResult, $request, &$arParams, &$arResult )
	{
		if( \COption::GetOptionString("askaron.geo", "set_location") == "Y" )
		{
			$bFirstLoad = ($request->getRequestMethod() == 'GET');

			if ($bFirstLoad)
			{
				$arLocation = self::getLocation();
				if ($arLocation)
				{
					$arProperty = self::getLocationProperty($arUserResult["PERSON_TYPE_ID"]);
					if ($arProperty)
					{
						$arUserResult["ORDER_PROP"][$arProperty["ID"]] = $arLocation["CODE"];
					}

					//TODO zip-code
				}
			}
		}
	}

	private static function getLocationProperty( $person_type_id )
	{
		$arResult = array();

		if ($person_type_id > 0)
		{
			if(\Bitrix\Main\Loader::includeModule("sale"))
			{
				$filter = array(
					'=ACTIVE' => 'Y',
//					'=UTIL' => 'N',
					'=PERSON_TYPE_ID' => $person_type_id,
					"=TYPE" => "LOCATION",
					"=IS_LOCATION" => "Y",
				);

				$result = \Bitrix\Sale\Internals\OrderPropsTable::getList(array(
					'select' => array('ID', "ACTIVE", 'PERSON_TYPE_ID', 'NAME', 'TYPE', 'REQUIRED', 'DEFAULT_VALUE'),
					'filter' => $filter,
					'order' => array('SORT' => 'ASC')
				));

				if ($row = $result->fetch())
				{
					$arResult = $row;
				}
			}
		}

		return $arResult;
	}



	//  OLD
	static public function OnSaleComponentOrderOneStepOrderProps(&$arResult, &$arUserResult, &$arParams=array())
	{
		if ( !isset( $arParams["COMPATIBLE_MODE"] ) ) // not new component
		{
			if (\COption::GetOptionString("askaron.geo", "set_location") == "Y")
			{
				$arPropLocation = self::getLocationPropertyArray($arResult);

				if ($arPropLocation)
				{
					$bSetNewLocation = false;

					$bSetNewLocation = (
						!isset($_REQUEST[$arPropLocation["FIELD_NAME"]]) // no old value from form
						||
						$_REQUEST["PROFILE_ID"] == "0" && $_REQUEST["profile_change"] == "Y" // new profile
					);

					// possible hack $_POST["is_ajax_post"] = N
					//(!isset($_POST["is_ajax_post"]) && !isset($_POST["confirmorder"])) // new page
					//	||
					//($_POST["PERSON_TYPE"] != $_POST["PERSON_TYPE_OLD"]) // new person type

					if ($bSetNewLocation)
					{
						$current_location_id = false;

						$arCurrentLocation = self::getLocation();

						if ($arCurrentLocation && $arCurrentLocation["ID"] > 0)
						{
							if ($arUserResult["DELIVERY_LOCATION"] != $arCurrentLocation["ID"])
							{
								$current_location_id = $arCurrentLocation["ID"];
							}
						}

						if ($current_location_id)
						{
							$arVariantFound = array(); // variant must be allowed for site

							if (is_array($arPropLocation["VARIANTS"]))
							{
								foreach ($arPropLocation["VARIANTS"] as $arItem)
								{
									if ($arItem["ID"] == $current_location_id)
									{
										$arVariantFound = $arItem;
										break;
									}
								}
							}

							if ($arVariantFound)
							{
								$arUserResult["DELIVERY_LOCATION"] = $arVariantFound["ID"];
								$arUserResult["DELIVERY_LOCATION_BCODE"] = $arVariantFound['CODE'];

								//if ($isProfileChanged || $isEmptyUserResult)
								//{
								$arUserResult["ORDER_PROP"][$arPropLocation["ID"]] = $arVariantFound["ID"];
								//}

								if ($arPropLocation["IS_LOCATION4TAX"] == "Y")
								{
									$arUserResult["TAX_LOCATION"] = $arVariantFound['ID'];
									$arUserResult["TAX_LOCATION_BCODE"] = $arVariantFound['CODE'];
								}

								if (is_array($arResult["ORDER_PROP"]["USER_PROPS_Y"]))
								{
									foreach ($arResult["ORDER_PROP"]["USER_PROPS_Y"] as $key => $arItem)
									{
										if ($arItem["IS_LOCATION"] == "Y")
										{
											self::setLocationProperty($arResult["ORDER_PROP"]["USER_PROPS_Y"][$key], $arVariantFound);
										}
									}
								}

								if (is_array($arResult["ORDER_PROP"]["USER_PROPS_N"]))
								{
									foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $key => $arItem)
									{
										if ($arItem["IS_LOCATION"] == "Y")
										{
											self::setLocationProperty($arResult["ORDER_PROP"]["USER_PROPS_N"][$key], $arVariantFound);
										}
									}
								}
							}


							// please, clear default value for zip-code in property settings
// 						TODO zip-code
//						if ( strlen( $arUserResult["DELIVERY_LOCATION_ZIP"] ) <= 0 )
//						{
//							$rsZipList = CSaleLocation::GetLocationZIP( $arUserResult["DELIVERY_LOCATION"] );
//							$arZip = $rsZipList->Fetch();
//							$zip = $arZip["ZIP"];
//
//							if (strlen($zip) > 0)
//							{
//								//$arUserResult["DELIVERY_LOCATION_ZIP"] = $zip;
//
//								if (is_array( $arResult["ORDER_PROP"]["USER_PROPS_Y"] ) )
//								{
//									foreach ( $arResult["ORDER_PROP"]["USER_PROPS_Y"] as $key => $arItem )
//									{
//										if ( $arItem["IS_ZIP"] == "Y" )
//										{
//											$arResult["ORDER_PROP"]["USER_PROPS_Y"][$key]["~VALUE"] = $zip;
//											$arResult["ORDER_PROP"]["USER_PROPS_Y"][$key]["VALUE"] =  htmlspecialcharsbx($zip);
//										}
//									}
//								}
//
//								if (is_array( $arResult["ORDER_PROP"]["USER_PROPS_N"] ) )
//								{
//									foreach ( $arResult["ORDER_PROP"]["USER_PROPS_N"] as $key => $arItem )
//									{
//										if ( $arItem["IS_ZIP"] == "Y" )
//										{
//											$arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["~VALUE"] = $zip;
//											$arResult["ORDER_PROP"]["USER_PROPS_N"][$key]["VALUE"] =  htmlspecialcharsbx($zip);
//										}
//									}
//								}
//							}
//						}

						}
					}
				}
			}
		}
	}

	private static function getLocationPropertyArray( &$arResult )
	{
		$result = false;

		if (is_array($arResult["ORDER_PROP"]["USER_PROPS_Y"]))
		{
			foreach ($arResult["ORDER_PROP"]["USER_PROPS_Y"] as $key => $arItem)
			{
				if ($arItem["IS_LOCATION"] == "Y")
				{
					$result = $arResult["ORDER_PROP"]["USER_PROPS_Y"][$key];
				}
			}
		}

		if (is_array($arResult["ORDER_PROP"]["USER_PROPS_N"]))
		{
			foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $key => $arItem)
			{
				if ($arItem["IS_LOCATION"] == "Y")
				{
					$result = $arResult["ORDER_PROP"]["USER_PROPS_N"][$key];
				}
			}
		}

		return $result;
	}

	private static function setLocationProperty( &$arProperty, $arVariantFound )
	{
		$arProperty["VALUE"] = $arVariantFound["ID"];

		// ?? from standart component
		$arProperty["VALUE_FORMATED"] = $arVariantFound["COUNTRY_NAME"].((strlen($arVariantFound["CITY_NAME"]) > 0) ? " - " : "").$arVariantFound["CITY_NAME"];

		if ( is_array( $arProperty["VARIANTS"] ) )
		{
			foreach ( $arProperty["VARIANTS"] as $key_variant => $arVariant )
			{
				if ( $arVariant["SELECTED"] == "Y" )
				{
					unset( $arProperty["VARIANTS"][ $key_variant ]["SELECTED"] );
				}

				if ( $arVariant["ID"] ==  $arVariantFound["ID"] )
				{
					$arProperty["VARIANTS"][ $key_variant ]["SELECTED"] = "Y";
				}
			}
		}
	}
}