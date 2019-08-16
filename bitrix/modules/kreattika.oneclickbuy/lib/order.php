<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# File: order.php                                                                                          #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y.                                                                      #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
namespace Kreattika\OneClickBuy;

use Bitrix\Main\Entity;

class OrderTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b_kreattika_oneclickbuy_order_entity';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\StringField('ACTIVE', array(
                'required' => true
            )),
            new Entity\StringField('STATUS', array(
                'required' => true
            )),
            new Entity\IntegerField('USER_ID', array(
                'required' => false
            )),
            new Entity\StringField('NAME', array(
                'required' => false
            )),
            new Entity\StringField('PHONE', array(
                'required' => false
            )),
            new Entity\StringField('EMAIL', array(
                'required' => false
            )),
            new Entity\StringField('ADDRESS', array(
                'required' => false
            )),
            new Entity\DatetimeField('DATE_INSERT', array(
                'required' => true
            )),
            new Entity\DatetimeField('DATE_UPDATE', array(
                'required' => false
            )),
            new Entity\IntegerField('PRODUCT_ID', array(
                'required' => true
            )),
            new Entity\IntegerField('QUANTITY', array(
                'required' => true
            )),
            new Entity\StringField('PRICE', array(
                'required' => false
            )),
            new Entity\StringField('CURRENCY', array(
                'required' => false
            )),
            new Entity\StringField('USER_DESCRIPTION', array(
                'required' => false
            )),
            new Entity\StringField('COMMENT', array(
                'required' => false
            )),
            new Entity\StringField('REQUEST_PATH', array(
                'required' => false
            )),
            new Entity\StringField('REQUEST_REFERER', array(
                'required' => false
            )),
            new Entity\StringField('REQUEST_IP', array(
                'required' => false
            )),
        );
    }

    public static function add(array $data)
    {

        #$MODULE_ID = GetModuleID(__FILE__);

        if( !isset($data['ACTIVE']) || empty($data['ACTIVE']) ):
            $data['ACTIVE'] = 'Y';
        endif;

        if( !isset($data['STATUS']) || empty($data['STATUS']) ):
            $data['STATUS'] = 'N';
        endif;

        if( !isset($data['DATE_INSERT']) || empty($data['DATE_INSERT']) ):
            $data['DATE_INSERT'] = new \Bitrix\Main\Type\DateTime(date('Y-m-d H:i:s',time()),'Y-m-d H:i:s');
        endif;

        $result = parent::add($data);

        if (!$result->isSuccess(true)):
            return $result;
        endif;

        return $result;
    }

    public static function update($primary, array $data)
    {
        $data['DATE_UPDATE'] = new \Bitrix\Main\Type\DateTime(date('Y-m-d H:i:s',time()),'Y-m-d H:i:s');

        $result = parent::update($primary, $data);

        if (!$result->isSuccess(true)):
            return $result;
        endif;

        return $result;
    }

}
?>