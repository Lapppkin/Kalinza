<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# File: kreattika_oneclickbuy_order.php                                                                    #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y.                                                                      #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?>
<?
$fileInfo = pathinfo(__FILE__);
$pattern = array("'/modules/kreattika.oneclickbuy/admin'si");
$TMP_BX_ROOT = preg_replace($pattern, array(""), $fileInfo['dirname']);
require_once($TMP_BX_ROOT."/modules/main/include/prolog_admin_before.php");

if(!$USER->CanDoOperation('kreattika_oneclickbuy'))
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$isAdmin = $USER->CanDoOperation('list_kreattika_oneclickbuy_order');

\Bitrix\Main\Loader::IncludeModule(GetModuleID(__FILE__));

IncludeModuleLangFile(__FILE__);
use \Bitrix\Main\Localization\Loc;

use Bitrix\Main\Entity;
use Bitrix\Main\Type;
use Bitrix\Main\Entity\Query;
use Bitrix\Main\Entity\ExpressionField;

use \Kreattika\OneClickBuy as MainData;

$sTableID = "tbl_kreattika_oneclickbuy_order";
$oSort = new CAdminSorting($sTableID, "ID", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);

$arOrderStatus = array(
    "N" => GetMessage("KOCB_LIST_STATUS_N"),
    "P" => GetMessage("KOCB_LIST_STATUS_P"),
    "F" => GetMessage("KOCB_LIST_STATUS_F"),
    "C" => GetMessage("KOCB_LIST_STATUS_C"),
);

$arOrderActive = array(
    "Y" => GetMessage("KOCB_ACTIVE_YES"),
    "N" => GetMessage("KOCB_ACTIVE_NO"),
);

if (!in_array($by, $lAdmin->GetVisibleHeaderColumns(), true))
{
    $by = 'ID';
}

function CheckFilter()
{
    global $FilterArr, $lAdmin;
    foreach ($FilterArr as $f) global $$f;
    return count($lAdmin->arFilterErrors)==0;
}

$FilterArr = Array(
    "find_active",
    "find_status",
    "find_user_id",
    "find_date",
    "find_product_id",
    "find_name",
    "find_phone",
    "find_email",
    "find_address",
);

$lAdmin->InitFilter($FilterArr);

$arFilter = Array();
if(CheckFilter())
{
    $arFilter = Array(
        "ACTIVE"	            => $find_active,
        "STATUS"	            => $find_status,
        "USER_ID"	            => $find_user_id,
        "DATE"	                => $find_date,
        "PRODUCT_ID"            => $find_product_id,
        "NAME"                  => $find_name,
        "PHONE"                 => $find_phone,
        "EMAIL"                 => $find_email,
        "ADDRESS"                => $find_address,
    );
}

if(($arID = $lAdmin->GroupAction()))
{
    if($_REQUEST['action_target']=='selected')
    {
        $rsData = MainData\LogTable::GetList(array('order' => array($by=>$order), 'filter' => $arFilter));
        while($arRes = $rsData->Fetch())
            $arID[] = $arRes['ID'];
    }

    foreach($arID as $ID)
    {
        $ID = IntVal($ID);
        if($ID <= 0)
            continue;
        switch($_REQUEST['action'])
        {
            case "delete":
                if(!MainData\LogTable::Delete($ID))
                    $lAdmin->AddGroupError(GetMessage("KOCB_LIST_ERR_DEL"), $ID);
                break;
        }
    }
}

$order = strtoupper($order);

$arCleanFilter = array();
foreach($arFilter as $keyFilter=>$elFilter):
    if( isset($elFilter) && !empty($elFilter) ):
        $arCleanFilter[$keyFilter] = $elFilter;
    endif;
endforeach;

#$arFilter = $filterValues = $arCleanFilter;
$arFilter = $arCleanFilter;

$usePageNavigation = true;
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'excel')
{
    $usePageNavigation = false;
}
else
{
    $navyParams = CDBResult::GetNavParams(CAdminResult::GetNavSize(
        $sTableID,
        array('nPageSize' => 20, 'sNavID' => $APPLICATION->GetCurPage().'?ENTITY_ID='.$ENTITY_ID)
    ));
    if ($navyParams['SHOW_ALL'])
    {
        $usePageNavigation = false;
    }
    else
    {
        $navyParams['PAGEN'] = (int)$navyParams['PAGEN'];
        $navyParams['SIZEN'] = (int)$navyParams['SIZEN'];
    }
}
$getListParams = array();

#$getListParams['select'] = $lAdmin->GetVisibleHeaderColumns();
$getListParams['select'] = array('*');
$getListParams['filter'] = $arFilter;
$getListParams['order'] = array($by => $order);

unset($filterValues);
if ($usePageNavigation)
{
    $getListParams['limit'] = $navyParams['SIZEN'];
    $getListParams['offset'] = $navyParams['SIZEN']*($navyParams['PAGEN']-1);
}

if ($usePageNavigation)
{
    $countQuery = new Entity\Query(MainData\OrderTable::getEntity());
    #$countQuery = new Query($entity_data_class::getEntity());
    $countQuery->addSelect(new ExpressionField('CNT', 'COUNT(1)'));
    $countQuery->setFilter($getListParams['filter']);
    $totalCount = $countQuery->setLimit(null)->setOffset(null)->exec()->fetch();
    unset($countQuery);
    $totalCount = (int)$totalCount['CNT'];
    if ($totalCount > 0)
    {
        $totalPages = ceil($totalCount/$navyParams['SIZEN']);
        if ($navyParams['PAGEN'] > $totalPages)
            $navyParams['PAGEN'] = $totalPages;
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = $navyParams['SIZEN']*($navyParams['PAGEN']-1);
    }
    else
    {
        $navyParams['PAGEN'] = 1;
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = 0;
    }
}

$rsData = MainData\OrderTable::getList($getListParams);
$rsData = new CAdminResult($rsData, $sTableID);

if ($usePageNavigation)
{
    $rsData->NavStart($getListParams['limit'], $navyParams['SHOW_ALL'], $navyParams['PAGEN']);
    $rsData->NavRecordCount = $totalCount;
    $rsData->NavPageCount = $totalPages;
    $rsData->NavPageNomer = $navyParams['PAGEN'];
}
else
{
    $rsData->NavStart();
}

$lAdmin->NavText($rsData->GetNavPrint(GetMessage("KOCB_LIST_NAV")));

$aContext=array();
$lAdmin->AddAdminContextMenu($aContext);

$aHeaders = array(
    array("id"=>"ID", "content"=>"ID", "sort"=>"ID", "default"=>true),
    array("id"=>"ACTIVE", "content"=>GetMessage("KOCB_ACTIVE"), "sort"=>"ACTIVE", "default"=>true),
    array("id"=>"STATUS", "content"=>GetMessage("KOCB_STATUS"), "sort"=>"STATUS", "default"=>true),
    array("id"=>"USER_ID", "content"=>GetMessage("KOCB_USER_ID"), "sort"=>"USER_ID", "default"=>true),
    array("id"=>"DATE_INSERT", "content"=>GetMessage("KOCB_DATE_INSERT"), "sort"=>"DATE_INSERT", "default"=>true),
    array("id"=>"DATE_UPDATE", "content"=>GetMessage("KOCB_DATE_UPDATE"), "sort"=>"DATE_UPDATE", "default"=>true),
    array("id"=>"PRODUCT_ID", "content"=>GetMessage("KOCB_PRODUCT_ID"), "sort"=>"PRODUCT_ID", "default"=>true),
    array("id"=>"QUANTITY", "content"=>GetMessage("KOCB_QUANTITY"), "sort"=>"QUANTITY", "default"=>true),
    array("id"=>"PRICE", "content"=>GetMessage("KOCB_PRICE"), "sort"=>"PRICE", "default"=>true),
    array("id"=>"CURRENCY", "content"=>GetMessage("KOCB_CURRENCY"), "sort"=>"CURRENCY", "default"=>true),
    array("id"=>"NAME", "content"=>GetMessage("KOCB_NAME"), "sort"=>"NAME", "default"=>true),
    array("id"=>"PHONE", "content"=>GetMessage("KOCB_PHONE"), "sort"=>"PHONE", "default"=>true),
    array("id"=>"EMAIL", "content"=>GetMessage("KOCB_EMAIL"), "sort"=>"EMAIL", "default"=>true),
    array("id"=>"ADDRESS", "content"=>GetMessage("KOCB_ADDRESS"), "sort"=>"ADDRESS", "default"=>true),
    array("id"=>"USER_DESCRIPTION", "content"=>GetMessage("KOCB_USER_DESCRIPTION"), "sort"=>"USER_DESCRIPTION", "default"=>true),
    array("id"=>"COMMENT", "content"=>GetMessage("KOCB_COMMENT"), "sort"=>"COMMENT", "default"=>true),
    array("id"=>"REQUEST_PATH", "content"=>GetMessage("KOCB_REQUEST_PATH"), "sort"=>"REQUEST_PATH", "default"=>true),
    array("id"=>"REQUEST_REFERER", "content"=>GetMessage("KOCB_REQUEST_REFERER"), "sort"=>"REQUEST_REFERER", "default"=>true),
    array("id"=>"REQUEST_IP", "content"=>GetMessage("KOCB_REQUEST_IP"), "sort"=>"REQUEST_IP", "default"=>true),
);

$lAdmin->AddHeaders($aHeaders);

$arOrderStatusList = COneClickBuy::getOrderStatusList();
$arOrderCurrencyList = COneClickBuy::getSystemCurrencyList();

while($arRes = $rsData->NavNext(true, "f_"))
{
    $row =& $lAdmin->AddRow($f_ID, $arRes);
    $row->AddViewField("ACTIVE", $f_ACTIVE == "Y" ? GetMessage("KOCB_ACTIVE_YES") : GetMessage("KOCB_ACTIVE_NO"));
    $row->AddViewField("STATUS", $arOrderStatusList[$f_STATUS]);
    $row->AddViewField("USER_ID", '<a href="'.COneClickBuy::getUserPath($f_USER_ID).'">'.COneClickBuy::getUserName($f_USER_ID).'</a>');
    $row->AddViewField("DATE_INSERT", $f_DATE_INSERT);
    $row->AddViewField("DATE_UPDATE", $f_DATE_UPDATE);
    $row->AddViewField("PRODUCT_ID", '<a href="'.COneClickBuy::getProductPath($f_PRODUCT_ID).'">'.COneClickBuy::getProductName($f_PRODUCT_ID).'</a>');
    $row->AddViewField("QUANTITY", htmlspecialcharsBack($f_QUANTITY));
    $row->AddViewField("PRICE", htmlspecialcharsBack($f_PRICE));
    $row->AddViewField("CURRENCY", $arOrderCurrencyList[$f_CURRENCY]);
    $row->AddViewField("NAME", htmlspecialcharsBack($f_NAME));
    $row->AddViewField("PHONE", htmlspecialcharsBack($f_PHONE));
    $row->AddViewField("EMAIL", htmlspecialcharsBack($f_EMAIL));
    $row->AddViewField("ADDRESS", htmlspecialcharsBack($f_ADDRESS));
    $row->AddViewField("USER_DESCRIPTION", htmlspecialcharsBack($f_USER_DESCRIPTION));
    $row->AddViewField("COMMENT", htmlspecialcharsBack($f_COMMENT));
    $row->AddViewField("REQUEST_PATH", htmlspecialcharsBack($f_REQUEST_PATH));
    $row->AddViewField("REQUEST_REFERER", htmlspecialcharsBack($f_REQUEST_REFERER));
    $row->AddViewField("REQUEST_IP", htmlspecialcharsBack($f_REQUEST_IP));

    $arActions = Array();

    $arActions[] = array(
        "ICON"=>"delete",
        "TEXT"=>GetMessage("KOCB_LIST_DEL"),
        "ACTION"=>"if(confirm('".GetMessage("KOCB_LIST_DEL_CONF")."')) ".$lAdmin->ActionDoGroup($f_ID, "delete")
    );

    $row->AddActions($arActions);
}

$lAdmin->AddGroupActionTable(Array(
    "delete"=>true,
));

$lAdmin->CheckListMode();

$APPLICATION->SetTitle(GetMessage("KOCB_LIST_TITLE"));
require_once ($DOCUMENT_ROOT.BX_ROOT."/modules/main/include/prolog_admin_after.php");

$oFilter = new CAdminFilter(
    $sTableID."_filter",
    array(
        GetMessage("KOCB_LIST_FLT_ACTIVE"),
        GetMessage("KOCB_LIST_FLT_STATUS"),
        GetMessage("KOCB_LIST_FLT_USER_ID"),
        //GetMessage("KOCB_LIST_FLT_DATE"),
        GetMessage("KOCB_LIST_FLT_PRODUCT_ID"),
        GetMessage("KOCB_LIST_FLT_NAME"),
        GetMessage("KOCB_LIST_FLT_PHONE"),
        GetMessage("KOCB_LIST_FLT_EMAIL"),
        GetMessage("KOCB_LIST_FLT_ADDRESS"),
    )
);


?>
    <form name="form1" method="GET" action="<?=$APPLICATION->GetCurPage()?>">
        <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
        <?$oFilter->Begin();?>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_ACTIVE")?></td>
            <td><select name="find_active">
                    <option value=""><?echo GetMessage("KOCB_LIST_FLT_ALL")?></option>
                    <?foreach($arOrderActive as $keyOrderActive=>$valueOrderActive):?>
                        <option value="<?=$keyOrderActive?>"<?if($find_active == $keyOrderActive) echo " selected"?>><?=$valueOrderActive?></option>
                    <?endforeach?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_STATUS")?></td>
            <td><select name="find_status">
                    <option value=""><?echo GetMessage("KOCB_LIST_FLT_ALL")?></option>
                    <?foreach($arOrderStatus as $keyOrderStatus=>$valueOrderStatus):?>
                    <option value="<?=$keyOrderStatus?>"<?if($find_status == $keyOrderStatus) echo " selected"?>><?=$valueOrderStatus?></option>
                    <?endforeach?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_USER_ID")?></td>
            <td><input name="find_user_id" value="<?=$find_user_id?>"/></td>
        </tr>
        <!--
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_DATE")?></td>
            <td><input name="find_date" value="<?=$find_date?>"/></td>
        </tr>
        //-->
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_PRODUCT_ID")?></td>
            <td><input name="find_product_id" value="<?=$find_product_id?>"/></td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_NAME")?></td>
            <td><input name="find_name" value="<?=$find_name?>"/></td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_PHONE")?></td>
            <td><input name="find_phone" value="<?=$find_phone?>"/></td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_EMAIL")?></td>
            <td><input name="find_email" value="<?=$find_email?>"/></td>
        </tr>
        <tr>
            <td><?echo GetMessage("KOCB_LIST_FLT_ADDRESS")?></td>
            <td><input name="find_address" value="<?=$find_address?>"/></td>
        </tr>

<?
$oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"form1"));
$oFilter->End();
?>
	</form>
<?
$lAdmin->DisplayList();
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
?>