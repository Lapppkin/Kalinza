<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $serverName;
?>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: #89cbf5; border-top: 1px solid #d3dcdd">
        <td></td>
        <td style="vertical-align: top; padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-family:Trebuchet MS; color: #FFFFFF">
            <p style="text-align: center; padding-bottom: 10px; border-bottom: 1px solid #9ccfef ;"><b>Контактные данные</b></p>
            <table width="100%" cellpadding="0" cellspacing="0" style="vertical-align top; font-size: 14px; padding-bottom: 30px;  color: #FFFFFF">
                <tbody>
                    <tr>
                        <td width="44%" align="left" style="padding-left: 6%;" valign="top">
                            <p style="margin: 0px 0px 5px 0px">Наши координаты:</p>
                            <b>429950 Россия,  Ленинградская область г. Санкт-Петербург, ул.Промышленная, д.91</b><br/>
                        </td>
                        <td width="44%" align="left" style="padding-left: 6%;" valign="top">
                            <p style="margin: 0px 0px 5px 0px">Как с нами связаться:</p>
                            <b>Тел.:  (800) 111-22-33</b><br/>
                            <b>e-mail:  info@#SITE_URL#</b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align:center;">
                <a style="color: #FFFFFF" href="<?=$serverName?>?MAILING_MESSAGE=#MAILING_MESSAGE#&MAILING_UNSUBSCRIBE=#MAILING_UNSUBSCRIBE#&utm_source=newsletter&utm_medium=email&utm_campaign=sotbit_mailing_#MAILING_EVENT_ID#">Отписаться от рассылки</a>
            </p>
        </td>
        <td></td>
    </tr>
</table>