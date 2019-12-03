<?php


namespace core;

use Sotbit\Regions\Internals\RegionsTable;

/**
 * Class Regionality
 *
 * @package core
 */
class Regionality
{

    /**
     * Get all regions.
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function getAllRegions(): array
    {
        return RegionsTable::GetList(array(
            'order'  => array(
                'ID' => 'asc',
                'SORT' => 'asc',
            ),
            'select' => array(
                'ID',
                'NAME',
                'DEFAULT_DOMAIN',
            ),
            'filter' => array(
                //'DEFAULT_DOMAIN' => 'Y'
            )
        ))->fetchAll();
    }

    /**
     * @return mixed
     */
    public static function getCurrentRegionEmails()
    {
        return $_SESSION['SOTBIT_REGIONS']['UF_EMAIL'];
    }

    /**
     * @return mixed
     */
    public static function getCurrentRegionPhones()
    {
        return $_SESSION['SOTBIT_REGIONS']['UF_PHONE'];
    }

    /**
     * @return mixed
     */
    public static function getCurrentRegionPhoneMain()
    {
        return $_SESSION['SOTBIT_REGIONS']['UF_PHONE'][0];
    }

    /**
     * @param $id
     */
    public static function setRegionId($id): void {
        $_SESSION['SOTBIT_REGIONS']['ID'] = $id;
    }

    /**
     * @return int
     */
    public static function getRegionFromCookie(): int {
        $region_id = $_COOKIE['sotbit_regions_id'] ?? 1;
        return (int) $region_id;
    }
}
