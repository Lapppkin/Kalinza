<?
$module_id = 'sotbit.mailing';
IncludeModuleLangFile(__FILE__);
CModule::IncludeModule("iblock");

$AddAutoloadClasses = CModule::AddAutoloadClasses(
    'sotbit.mailing',
    array(
        "CSotbitMailingHelp" => "classes/general/CSotbitMailingHelp.php",
        "CModuleOptions" => "classes/general/CModuleOptions.php",
        "CMailingDetailOptions" => "classes/general/CMailingDetailOptions.php",
        "CSotbitMailingEvent" => "classes/mysql/CSotbitMailingEvent.php",
        "CSotbitMailingMessage" => "classes/mysql/CSotbitMailingMessage.php",
        "CSotbitMailingMessageText" => "classes/mysql/CSotbitMailingMessageText.php",
        "CSotbitMailingMessageTemplate" => "classes/mysql/CSotbitMailingMessageTemplate.php",
        "CSotbitMailingUnsubscribed" => "classes/mysql/CSotbitMailingUnsubscribed.php",
        "CSotbitMailingUndelivered" => "classes/mysql/CSotbitMailingUndelivered.php",
        "CSotbitMailingSubscribers" => "classes/mysql/CSotbitMailingSubscribers.php",
        "CSotbitMailingCategories" => "classes/mysql/CSotbitMailingCategories.php",
        "CsotbitMailingSubTools" => "classes/general/CsotbitMailingSubTools.php",
        "CSotbitMailingSectionTable" => "classes/mysql/CSotbitMailingSection.php",
        "MCAPI" => "classes/general/MCAPI.class.php",
    )
);

/**
* ����� �������� ������, ����������� ���������������� �������� ��������� � ������ ������ ��� �� ������.
*
* ��������� ������:
* <ul>
* <li><b>EVENT_ADD_MAILING</b> - �������� ��������� ������� ��� ������</li>
* <li><b>MODULE_ID</b> - ������������� ������</li>
* </ul> 
* 
*/
class CSotbitMailingTools
{
    CONST EVENT_ADD_MAILING = "SOTBIT_MAILING_EVENT_SEND";
    CONST MODULE_ID = "sotbit.mailing";
    private static $sendMail = array();
    private static $isAgent = false;



    private static $DEMO = 0;

	public function __construct()
	{
		$this->setDemo();
	}

	private static function setDemo()
	{
		static::$DEMO = CModule::IncludeModuleEx("sotbit.mailing");
	}

	public function getDemo()
	{
		if(static::$DEMO == 0 || static::$DEMO == 3)
			return false;
		else
			return true;
	}

	public function ReturnDemo()
	{
		return static::$DEMO;
	}



    /**
    * ����� ��������� ������ �������� ��������� �� ��������� ��������.
    * 
    * ������� ����� ���� � ������� ��������� ������� ��������
    * �������� ������ � ������� ������� (������� �� �������� ������)
    * ����������� �������� ����� ��������� ���������� sotbit:sotbit.mailing.logic � ��������� ��� ���������� $mailingInfo['TEMPLATE'], $templateInfo
    * ����� ���������� ��������:
    * ������������ ���
    * ����������� ������� b_sotbit_mailing_event, b_sotbit_mailing_message_template:
    *   - � ������� b_sotbit_mailing_event �������� ���� COUNT_RUN ����������������,
    *   � ���� DATE_LAST_RUN ��������������� ������� ����,
    *   MAILING_WORK ��������������� � "N",
    *   MAILING_WORK_COUNT � 0
    *   - � ������� b_sotbit_mailing_message_template �������� ���� COUNT_END
    *   ��������������� � ������������������ �������� ���� COUNT_RUN ������� b_sotbit_mailing_event 
    * 
    * @param string $ID ������������� ��������, �� ������� �������������� ��������
    * 
    * @param aray $MORE_OPTIONS_TEMPLATE ������ �������������� ���������� ��� ��������.
    * 
    * @return void
    *
    */
    public function StartMailing($ID = 0, $MORE_OPTIONS_TEMPLATE = array())
    {
        global $APPLICATION;
        global $DB;
        $mailingInfo = CSotbitMailingEvent::GetByID($ID);

        if($mailingInfo['ACTIVE'] == 'Y')
        {
            set_time_limit(0);

            //������� ����� ���������
            //START
            if($mailingInfo["COUNT_RUN"] != 0)
            {
                CSotbitMailingHelp::ProgressFileDelete($ID, $mailingInfo["COUNT_RUN"]-1);
            }
            if($mailingInfo['MAILING_WORK'] == 'N')
            {
                $arrProgress['COUNT_ALL'] = 999999;
                $arrProgress['COUNT_NOW'] = 0;
                $arrProgress['COUNT_SEND'] = 0;
                $arrProgress['EMAIL_TO_SEND'] = 0;
                $arrProgress['EMAIL_TO_EXCLUDE_UNSUBSCRIBED'] = 0;
                $arrProgress['EMAIL_TO_EXCLUDE_HOUR_AGO'] = 0;
                $arrProgress['MAILING_WORK'] = 'Y';
                CSotbitMailingHelp::ProgressFile($ID, $mailingInfo["COUNT_RUN"], $arrProgress);
            }
            //END

            $templateInfo = unserialize($mailingInfo['TEMPLATE_PARAMS']);
            $templateInfo['MAILING_EVENT_ID'] = $mailingInfo['ID'];
            $templateInfo['MAILING_SITE_URL'] = $mailingInfo['SITE_URL'];
            $templateInfo['MAILING_COUNT_RUN'] = $mailingInfo['COUNT_RUN'];
            $templateInfo['MAILING_TEMPLATE'] = $mailingInfo['TEMPLATE'];
            $templateInfo['MAILING_EXCLUDE_HOUR_AGO'] = $mailingInfo['EXCLUDE_HOUR_AGO'];
            $templateInfo['MAILING_EXCLUDE_UNSUBSCRIBED_USER'] = $mailingInfo['EXCLUDE_UNSUBSCRIBED_USER'];
            $templateInfo['MAILING_EXCLUDE_UNSUBSCRIBED_USER_MORE'] = unserialize($mailingInfo['EXCLUDE_UNSUBSCRIBED_USER_MORE']);
            // ������
            $templateInfo['MAILING_MAILING_WORK_COUNT'] = $mailingInfo['MAILING_WORK_COUNT'];
            $templateInfo['MAILING_PACKAGE_COUNT'] = COption::GetOptionString('sotbit.mailing', 'MAILING_PACKAGE_COUNT', '3000');

            unset($templateInfo['MAILING_INFO']['TEMPLATE_PARAMS']);

            if($MORE_OPTIONS_TEMPLATE)
            {
                $templateInfo['MORE_OPTIONS_TEMPLATE'] = $MORE_OPTIONS_TEMPLATE;
            }

            //�������� ��������
            $APPLICATION->IncludeComponent('sotbit:sotbit.mailing.logic', $mailingInfo['TEMPLATE'], $templateInfo);

            //������� ���
            global $CACHE_MANAGER;
            //$CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetEmailSendMessageTime_'.$mailingInfo['ID'].'_'.$mailingInfo['COUNT_RUN']+1);
            //$CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetEmailSendMessageTime_'.$mailingInfo['ID'].'_'.$mailingInfo['COUNT_RUN']);
            //$CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetUnsubscribedAllMailing');
            $CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetMailingInfo');
            $CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetEventTemplate_'.$mailingInfo['ID']);

            //������� ��������� � ��������
            CSotbitMailingEvent::Update($ID, array(
                "COUNT_RUN" => $mailingInfo["COUNT_RUN"]+1,
                "DATE_LAST_RUN" => Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID))),
                "MAILING_WORK" => "N",
                "MAILING_WORK_COUNT" => 0,
                "MAILING_WORK_PARAM" => ""
            ));

            $resEventTemplate = CSotbitMailingMessageTemplate::GetList(array('COUNT_START'=>'DESC'),array('ID_EVENT'=>$ID,'ARCHIVE'=>'N'),false,array('ID','COUNT_END'));
            while($arrEventTemplate = $resEventTemplate->Fetch()) {
                CSotbitMailingMessageTemplate::Update($arrEventTemplate['ID'],array('COUNT_END'=>$mailingInfo["COUNT_RUN"]+1));
                break;
            }
        }
    }

    public function AgentStartTemplate($ID = 0)
    {
        global $USER;
        if(!is_object($USER))
        {
            $USER = new CUser();
        }

        $mailingInfo = CSotbitMailingEvent::GetByID($ID);
        // ��������� ����� ������ ������
        $hourNow = date('H');
        self::$isAgent = true; ###############################
        if($mailingInfo['EVENT_PARAMS_AGENT_AROUND'] == 'Y')
        {
            CSotbitMailingTools::StartMailing($ID, array('TYPE_StartMailing' => 'AGENT'));
        }
        elseif($hourNow >= $mailingInfo['AGENT_TIME_START'] && $hourNow < $mailingInfo['AGENT_TIME_END'])
        {
            CSotbitMailingTools::StartMailing($ID, array('TYPE_StartMailing' => 'AGENT'));
        }
        self::send(); ###############################
        return "CSotbitMailingTools::AgentStartTemplate($ID);";
    }

    /**
    * ����� �������� ������ � ��������� � ������� b_sotbit_mailing_message, �������� ������ ��� ��������.
    * 
    * - ���� � ��������� ����� ����� �������� ��� EMAIL_FROM ��� EMAIL_TO ��� SUBJECT, �� ����� ������������ ����� ��������� � ���������� false
    * - ��������������� �������� �����������, ����������� ����
    * - ����� ���������� ��������� � ������� b_sotbit_mailing_message � ������, ���� ������� ������� ����� ��������,
    *  ���������� ����� CSotbitMailingTools::SendMessage() ��� ���������������� �������� ���������
    * - ���������� ������ �� ����� ��������� ��������. ����������� � ����� ����������� � ����.
    * 
    * @param array $SETTING ������ �������������� ����������
    * 
    * @param array $arFields ������ ������ ��������� ��� ��������
    * 
    * @param array $arParams ������ ���������� (�� ������������)
    * 
    * @return array|boolean ������ ���������� ������ ������, ���������� ID ������������ ���������, ���� SEND, ������ � �������� PROGRESS ���������� ���������� �� ��������. false � ������ ������� ���������� ����������.
    *
    */
    public function AddMailingMessage($SETTING=array(), $arFields=array(), $arParams=array())
    {
        global $DB;
        $result = array();

        if(empty($SETTING["MAILING_ID"])){
            return false;
        }

        // ������� ��������
        $MailingList = CSotbitMailingHelp::GetMailingInfo();
        $MailingInfo = $MailingList[$SETTING["MAILING_ID"]];
        $MailingInfo['EXCLUDE_UNSUBSCRIBED_USER_MORE'] = unserialize($MailingInfo['EXCLUDE_UNSUBSCRIBED_USER_MORE']);


        $arFields['EMAIL_TO'] = trim($arFields['EMAIL_TO']);

        if(empty($arFields['EMAIL_FROM']) ||
            empty($arFields['EMAIL_TO']) ||
            empty($arFields['SUBJECT'])/* ||
           empty($arFields['MESSEGE']) */
        ) {

            //������� ����� ���������
            //START
            $arrProgress = CSotbitMailingHelp::ProgressFileGetArray($SETTING["MAILING_ID"], $MailingInfo['COUNT_RUN']);
            $arrProgress['COUNT_NOW'] = $arrProgress['COUNT_NOW']+1;
            CSotbitMailingHelp::ProgressFile($SETTING["MAILING_ID"], $MailingInfo['COUNT_RUN'], $arrProgress);
            // END

            return false;
        }


        // �������� ������ ���������� � �������� ������
        // START  
        // ������� ID ��������� � ������

        $ReplaceMessage = array();
        $ReplaceMessage["MAILING_EVENT_ID"] = $MailingInfo['ID'];

        // �������� � ������ ������ �� ������� �� ��������
        //$ReplaceMessage["MAILING_UNSUBSCRIBE"] = $arFields['EMAIL_TO'].'||'.$NextMessageId.'||'.$SETTING["MAILING_ID"];

        // ���������� �������� �����������, ������� ����
        // START
        if($MailingInfo['USER_AUTH']=='Y' && $arFields['PARAM_MESSEGE']['USER_ID']) {
            $USER_AUTH_SOL = randString(15, array("abcdefghijklnmopqrstuvwxyz","ABCDEFGHIJKLNMOPQRSTUVWXYZ","0123456789"));
            $arFields['PARAM_MESSEGE']['USER_AUTH'] = $USER_AUTH_SOL;
            $arFields['MESSEGE_PARAMETR']['USER_AUTH'] = $USER_AUTH_SOL;
            $arFields['MESSEGE_PARAMETR']['USER_ID'] = $arFields['PARAM_MESSEGE']['USER_ID'];
        }
        // END

        $arFields['MESSEGE'] = CSotbitMailingHelp::ReplaceVariables($arFields['MESSEGE'], $ReplaceMessage);

        //��������� PARAM_MESSEGE ����, ��� ���������� ���������� �����
        //START
        unset($arFields['PARAM_MESSEGE']['RECOMMEND_PRODUCT_ID']);
        unset($arFields['PARAM_MESSEGE']['VIEWED_PRODUCT_ID']);
        unset($arFields['PARAM_MESSEGE']['BASKET_PRODUCT_ID']);
        //END
        $arFields['PARAM_MESSEGE'] = serialize($arFields['PARAM_MESSEGE']);

        if($arFields['MESSEGE_PARAMETR'] && $ReplaceMessage){
            $arFields['MESSEGE_PARAMETR'] = array_merge($arFields['MESSEGE_PARAMETR'], $ReplaceMessage);
        }

        $arFields['MESSEGE_PARAMETR'] = serialize($arFields['MESSEGE_PARAMETR']);
        //���������� ������ � ������� b_sotbit_mailing_message
        /*          */
        $MESSAGE_ID = CSotbitMailingMessage::Add(array(
            'ID_EVENT' => $MailingInfo['ID'],
            'DATE_CREATE' => Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID))),
            'SEND_SYSTEM' => $MailingInfo['EVENT_SEND_SYSTEM'],
            'EMAIL_FROM' =>  $arFields['EMAIL_FROM'],
            'EMAIL_TO' =>  $arFields['EMAIL_TO'],
            'COUNT_RUN' => $MailingInfo['COUNT_RUN']+1,
            'BCC' =>  $arFields['BCC'],
            'SUBJECT' =>  $arFields['SUBJECT'],
            'MESSEGE' =>  $arFields['MESSEGE'],
            'MESSEGE_PARAMETR' => $arFields['MESSEGE_PARAMETR'],
            'PARAM_1' =>  $arFields['PARAM_1'],
            'PARAM_2' =>  $arFields['PARAM_2'],
            'PARAM_3' =>  $arFields['PARAM_3'],
            'PARAM_MESSEGE' =>  $arFields['PARAM_MESSEGE'],
        ));
        if($MESSAGE_ID){
            $result['ID'] = $MESSAGE_ID;
        }

        //���� ������� ����� �������� ������
        //START
        if($MailingInfo['MODE'] == 'WORK' && !self::$isAgent) { #############################

            CSotbitMailingTools::SendMessage(
                array(
                    'ID_EVENT' => $MailingInfo['ID'],
                    'ID' => $MESSAGE_ID
                )
            );
            $result['SEND'] = 'Y';
        }
        ###############################
        if($MailingInfo['MODE'] == 'WORK' && self::$isAgent){
            self::$sendMail[] = ['ID_EVENT' => $MailingInfo['ID'], 'ID' => $MESSAGE_ID];
        }
        ###############################
        //END

        if($_GET['SOTBIT_MAILING_DETAIL']) {
            CSotbitMailingHelp::slaap(COption::GetOptionString('sotbit.mailing', 'MAILING_MESSAGE_SLAAP','0.001'));
        }

        //END


        // ������� ����� ���������
        // START
        $arrProgress = CSotbitMailingHelp::ProgressFileGetArray($SETTING["MAILING_ID"], $MailingInfo['COUNT_RUN']);

        if(empty($arrProgress['COUNT_ALL'])){
            $arrProgress['COUNT_ALL'] = $SETTING['PROGRESS_COUNT_ALL'];
        }
        $arrProgress['COUNT_NOW'] = $arrProgress['COUNT_NOW']+1;
        $arrProgress['COUNT_SEND'] = $arrProgress['COUNT_SEND']+1;
        $arrProgress['EMAIL_TO_SEND'] = $arrProgress['EMAIL_TO_SEND']+1;

        $result['PROGRESS'] = $arrProgress;
        CSotbitMailingHelp::ProgressFile($SETTING["MAILING_ID"], $MailingInfo['COUNT_RUN'], $arrProgress, array('EMAIL_TO_SEND_INFO' => $arFields['EMAIL_TO']));

        // END

        return $result;
    }

    ###############################
    public static function send()
    {
        foreach(self::$sendMail as $send)
        {
            CSotbitMailingTools::SendMessage(
                array(
                    'ID_EVENT' => $send['ID_EVENT'],
                    'ID' => $send['ID']
                )
            );
            CSotbitMailingHelp::slaap(COption::GetOptionString('sotbit.mailing', 'MAILING_MESSAGE_SLAAP', '0.001'));
        }
    }
    ###############################

    /**
    * ����� ���������� ���������������� �������� ���������
    * 
    * - � ������ ������ ������ ��������� ���� SEND_ERROR � ������� b_sotbit_mailing_message,
    * ����������� ���������� � ��������� �� ������� b_sotbit_mailing_message_template (�������� ����� ���������)
    * - � ��������� ��������� ����������� �������� ����������� � ����
    * - � ������ ��������� ���������� ��� ����������, ����� ������������ ������������, ������������ ����� � ����������� � ���� ������ � � ���� "��"
    * ������� �������� (��� ������� BITRIX):
    *   - ���� ����������� ���� BCC (������� �����), �� ����� ��������� � ��� ��� ��� �� ��������� �������� �������
    *   - � ����� ������ ��������� (�������� MESSEGE) ����������� ������ �������� � ��������� src = /bitrix/admin/sotbit_mailing_img.php?MAILING_MESSAGE='.$SETTING['ID'], ������ ������ ��������� � ���� ���������� ��� �������� ������.
    *   - ��������� �������� ������� ��� �������� ������
    *   - ����������� ������ � ������� b_sotbit_mailing_message, ��������������� ����:
    *       - 'SEND'=>'Y' - ���� �������� ������
    *       - 'DATE_SEND' - ��������������� ���� �������� ���������
    *       - 'SEND_ERROR' => '' - �������� ������ ��� ������
    *       - 'SEND_SYSTEM' - ��������������� �������� ������� (BITRIX)
    * 
    * @param array $SETTING ������ ����������, �������� � ���� ������� ID_EVENT - ������������� �������� � ID - ������������� ������������� ���������
    * 
    * @param array $arFields ������ ������ ��� �������� (�� ������������)
    * 
    * @return int|boolean ���������� ������������� ���������� ��������� �������, ��� �� false � ������ ���� ��������� ��� ����������, ������ ������������ ������������� ������������� ���������, �� ������� ���������� ������ sotbit.mailing ��� ����� ��� ���������������� ������. 
    *
    */
    public function SendMessage($SETTING = array(), $arFields = array())
    {
        global $DB;
        $module_status = CModule::IncludeModuleEx('sotbit.mailing');
        if($module_status == '0')
        {
            CSotbitMailingMessage::Update($SETTING['ID'], array(
                'SEND_ERROR' => GetMessage('NOT_FOUND')
            ));
            return false;
        }
        elseif($module_status == '3')
        {
            CSotbitMailingMessage::Update($SETTING['ID'], array(
                'SEND_ERROR' => GetMessage('DEMO_END')
            ));
            return false;
        }

        // ���� ����� ���������
        if(empty($SETTING['ID']))
        {
            return false;
        }

        $InfoSend = CSotbitMailingMessage::GetByIDInfoSend($SETTING['ID']);
        $InfoSend['PARAM_MESSEGE'] = unserialize($InfoSend['PARAM_MESSEGE']);
        $message_id = '';
        $helper = new CSotbitMailingHelp();
        if($InfoSend)
        {
            $SETTING['ID_EVENT'] = $InfoSend['ID_EVENT'];
            $arFields['ID_EVENT'] = $InfoSend['ID_EVENT'];
            $arFields['EMAIL_FROM'] = $InfoSend['EMAIL_FROM'];
            $arFields['EMAIL_TO'] = $InfoSend['EMAIL_TO'];
            $arFields['SUBJECT'] = $InfoSend['SUBJECT'];
            $arFields['MESSEGE'] = $InfoSend['MESSEGE'];
            $arFields['BCC'] = $InfoSend['BCC'];
        }
        else
        {
            return false;
        }

        if($InfoSend['SEND'] == 'Y')
        {
            return false;
        }

        // ������� ��������
        $MailingList = CSotbitMailingHelp::GetMailingInfo();
        $MailingInfo = $MailingList[$SETTING["ID_EVENT"]];

        $eventMessageId = $helper->EventTemplateCheck($MailingInfo['EVENT_TYPE'], $MailingInfo['NAME']);

        //���������� ���������������� ������� ������ ���������
        $arFieldsCompile = array(
            'MESSEGE' => $arFields['MESSEGE'],
            'EMAIL_FROM' => $arFields['EMAIL_FROM'],
            'EMAIL_TO' => $arFields['EMAIL_TO'],
            'SUBJECT' => $arFields['SUBJECT'],
        );
        $messageText = $helper->CompileMessageText($MailingInfo['EVENT_TYPE'], $arFieldsCompile, $eventMessageId);

        //������� ������ � ������ ��������� �������, ������� ������ � ���� ����������
        $messageText = $helper->ReplaceTemplateLinks($messageText, $MailingInfo["SITE_URL"]);

        // ���������� ���������� ��� ������ � ������ ���������
        $ReplaceMessage["MAILING_MESSAGE"] = $SETTING['ID'];
        $ReplaceMessage["MAILING_EVENT_ID"] = $SETTING['ID_EVENT'];

        // ���������� �������� �����������, ������� ����
        // START
        if($MailingInfo['USER_AUTH']=='Y' && $InfoSend['PARAM_MESSEGE']['USER_AUTH']) {
            $ReplaceMessage["MAILING_MESSAGE"] = $ReplaceMessage["MAILING_MESSAGE"].'&USER_AUTH='.$InfoSend['PARAM_MESSEGE']['USER_AUTH'];
        }
        // END

        //��� �������
        $ReplaceMessage['MAILING_UNSUBSCRIBE'] = $SETTING['ID'].'||'.$SETTING['ID_EVENT'];

        //������� URL ����� ����� (��� ���������)
        $ReplaceMessage['SITE_URL'] = parse_url($MailingInfo["SITE_URL"], PHP_URL_HOST);

        //������� ���������� �� ���� ��������� ������� ���� ����������
        $arFields['MESSEGE'] = CSotbitMailingHelp::ReplaceVariables($messageText, $ReplaceMessage);
        $arFields['MESSEGE'] = htmlspecialcharsBack($arFields['MESSEGE']);
        $arFields['EMAIL_FROM'] = htmlspecialcharsBack($arFields['EMAIL_FROM']);
        $arFields['SUBJECT'] = htmlspecialcharsBack($arFields['SUBJECT']);

        if($MailingInfo['EVENT_SEND_SYSTEM'] == 'BITRIX')
        {
            $arrSiteId = CSotbitMailingHelp::GetSiteId();

            //���� ���� �����, ������� �����
            if($arFields['BCC'])
            {
                $arFields['BCC'] = htmlspecialcharsBack($arFields['BCC']);
                $BCC = $arFields;

                $BCC['EMAIL_TO'] = $arFields['BCC'];
                $BCC['SUBJECT'] = $BCC['SUBJECT'].' - '. $arFields['EMAIL_TO'];
                unset($BCC['BCC']);
                $send_id = CEvent::Send(self::EVENT_ADD_MAILING, $arrSiteId, $BCC);
                unset($arFields['BCC']);
            }

            $arFields['MESSEGE'] .=  '<img src="'.$MailingInfo['SITE_URL'].'/bitrix/admin/sotbit_mailing_img.php?MAILING_MESSAGE='.$SETTING['ID'].'" width="1px" height="1px"  />';

            $send_id = CEvent::Send(self::EVENT_ADD_MAILING, $arrSiteId, $arFields, "Y");
            if($send_id)
            {
                CSotbitMailingMessage::Update($SETTING['ID'], array(
                    'SEND'=>'Y',
                    'DATE_SEND'=>Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID))),
                    'SEND_ERROR' => '',
                    'SEND_SYSTEM' => $MailingInfo['EVENT_SEND_SYSTEM'],
                ));
                return $send_id;
            }
        }

        if($MailingInfo['EVENT_SEND_SYSTEM'] == 'UNISENDER')
        {
            // ������� ���  � ����� �����������
            //START
            $arFields_EMAIL_FROM = $arFields['EMAIL_FROM'];
            if(stripos($arFields_EMAIL_FROM, '<') !== false) {
                $ARR_EMAIL_FROM = explode('<',$arFields_EMAIL_FROM);
                $ARR_EMAIL_FROM[1] = str_replace(">", "",  $ARR_EMAIL_FROM[1]);
                $sender_name =  $ARR_EMAIL_FROM[0];
                $sender_email =  $ARR_EMAIL_FROM[1];
            }
            elseif($arFields_EMAIL_FROM) {
                $sender_name =  $ARR_EMAIL_FROM[0];
                $sender_email = $arFields_EMAIL_FROM;
                $sender_name = COption::GetOptionString('sotbit.mailing', 'UNSENDER_SENDER_NAME');
            }

            if(empty($sender_name)){
                $sender_name = COption::GetOptionString('sotbit.mailing', 'UNSENDER_SENDER_NAME');
            }
            if(empty($sender_email)){
                $sender_email = COption::GetOptionString('sotbit.mailing', 'UNSENDER_SENDER_EMAIL');
            }
            //END

            $arFields_MESSEGE = $arFields['MESSEGE'].' <img src="'.$MailingInfo['SITE_URL'].'/bitrix/admin/sotbit_mailing_img.php?MAILING_MESSAGE='.$SETTING['ID'].'" width="1px" height="1px"  />';

            $arrSender = array(
                'sender_name' => $sender_name,
                'sender_email' => $sender_email,
                'email' => $arFields['EMAIL_TO'],
                'subject' => $arFields['SUBJECT'],
                'body' =>  $arFields_MESSEGE,
                'list_id' => $MailingInfo['EVENT_SEND_SYSTEM_CODE'],
                'user_campaign_id' => $SETTING['ID_EVENT'],
                'track_read' => 1 ,
                'wrap_type' =>COption::GetOptionString('sotbit.mailing', 'UNSENDER_WRAP_TYPE'),
            );

            $sendEmail = CSotbitMailingHelp::QueryUniSender('sendEmail', $arrSender);


            if($sendEmail['error'])
            {
                CSotbitMailingMessage::Update($SETTING['ID'], array(
                    'SEND_ERROR' => $sendEmail['error'],
                    'SEND_SYSTEM' => $MailingInfo['EVENT_SEND_SYSTEM'],
                ));
            }

            if($sendEmail['result']['email_id'])
            {
                CSotbitMailingMessage::Update($SETTING['ID'], array(
                    'SEND'=>'Y',
                    'SEND_SYSTEM_MESSEGE_CODE' => $sendEmail['result']['email_id'],
                    'DATE_SEND'=>Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID))),
                    'SEND_ERROR' => '',
                    'SEND_SYSTEM' => $MailingInfo['EVENT_SEND_SYSTEM']
                ));

                //���� ���� �����, ������� �����
                if($arFields['BCC'])
                {
                    $arrSiteId = CSotbitMailingHelp::GetSiteId();
                    $arFields['BCC'] = htmlspecialcharsBack($arFields['BCC']);
                    $BCC = $arFields;

                    $BCC['EMAIL_TO'] = $arFields['BCC'];
                    $BCC['SUBJECT'] = $BCC['SUBJECT'].' - '. $arFields['EMAIL_TO'];
                    unset($BCC['BCC']);

                    $send_id = CEvent::Send(self::EVENT_ADD_MAILING, $arrSiteId, $BCC, "Y");
                    unset($arFields['BCC']);
                }
                return $sendEmail['result']['email_id'];
            }
        }
    }

    // �������� �������� ��� ��������
    /**
    * ����� ��������� ������������� � ������������, ������� ��� ������������ ������, ������� ������ �� �������������
    * 
    * @return void
    *
    */
    public function MailingNeedAction()
    {
        global $DB;

        //������ ������������� � ������������
        //START
        $arrUser = array();
        $dbResUser = CUser::GetList($by, $order,  array(), array('FIELDS'=>array('ID','EMAIL')));
        while($arItemsUser = $dbResUser->Fetch())
        {
            $arrUser[$arItemsUser['EMAIL']] = $arItemsUser;
        }

        $dbSubscrib = CSotbitMailingSubscribers::GetList(Array(),Array('USER_ID'=>'0'), false, array('ID','EMAIL_TO','USER_ID'));
        while($resSubscrib = $dbSubscrib->Fetch())
        {
            if($arrUser[$resSubscrib['EMAIL_TO']])
            {
                CSotbitMailingSubscribers::Update($resSubscrib['ID'], array('USER_ID' => $arrUser[$resSubscrib['EMAIL_TO']]['ID']));
            }
        }
        //END

        //�������� ������� ������� ������ �� �������������
        //START
        $db_activeTemp = CSotbitMailingEvent::GetList(array(), array('ACTIVE' => 'Y'), false, array('ID', 'TEMPLATE_PARAMS'));
        while($res_activeTemp = $db_activeTemp->Fetch())
        {
            $arParams = array();
            $arParams = unserialize($res_activeTemp['TEMPLATE_PARAMS']);
            $arParams['MAILING_EVENT_ID'] = $res_activeTemp['ID'];

            //���������� ������
            //START
            if($arParams['NEW_COUPON_ADD'] == 'Y' && \Bitrix\Main\Loader::includeModule('sale'))
            {
                $arNewCoupons = array();
                $filterMessages = array(
                    'ID_EVENT' => $arParams['MAILING_EVENT_ID'],
                    '>=DATE_CREATE' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H")-$arParams['NEW_COUPON_LIFETIME']-24, date("i"), 0, date("n"), date("d"), date("Y"))),
                    '<=DATE_CREATE' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H")-$arParams['NEW_COUPON_LIFETIME']+24, date("i"), 0, date("n"), date("d"), date("Y"))),
                );

                $dbMessages = CSotbitMailingMessage::GetList(array(), $filterMessages, false, array('ID', 'PARAM_2', 'PARAM_MESSEGE'));
                while($message = $dbMessages->Fetch())
                {
                    $message['PARAM_MESSEGE'] = unserialize($message['PARAM_MESSEGE']);
                    if($message['PARAM_2'])
                    {
                        $arNewCoupons[$message['PARAM_2']] = $message['PARAM_2'];
                    }
                    if($message['PARAM_MESSEGE']['COUPON'])
                    {
                        $arNewCoupons[$message['PARAM_MESSEGE']['COUPON']] = $message['PARAM_MESSEGE']['COUPON'];
                    }
                }

                if(count($arNewCoupons) > 0)
                {
                    $lifetimeTo = (new \Bitrix\Main\Type\DateTime())->add(-$arParams['NEW_COUPON_LIFETIME'].' hours');

                    $arBasketRuleCoupons = \Bitrix\Sale\Internals\DiscountCouponTable::getList(array(
                        'filter' => array(
                            'COUPON' => $arNewCoupons,
                            'DISCOUNT_ID' => $arParams['NEW_COUPON_DISCOUNT_ID'],
                            'DATE_APPLY' => false,
                            '<=DATE_CREATE' => $lifetimeTo
                        )
                    ));

                    while($basketRuleCoupon = $arBasketRuleCoupons->Fetch())
                    {
                        if($arParams['NEW_COUPON_LIFETIME_ACTION'] == 'DELETE')
                        {
                            \Bitrix\Sale\Internals\DiscountCouponTable::delete($basketRuleCoupon['ID']);
                        }
                        elseif($arParams['NEW_COUPON_LIFETIME_ACTION'] == 'DEACTION')
                        {
                            \Bitrix\Sale\Internals\DiscountCouponTable::update($basketRuleCoupon['ID'], array('ACTIVE' => 'N'));
                        }
                    }
                }
            }

            if($arParams['COUPON_ADD'] == 'Y' && CModule::IncludeModule("catalog"))
            {
                //������� ��� ������ �� ������ ��������
                //START
                $arrCoupon = array();
                $fillterMesssageGet = array(
                    'ID_EVENT' => $arParams['MAILING_EVENT_ID'],
                    '>=DATE_CREATE' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H")-$arParams['COUPON_TIME_LIFE']-24, date("i"), 0, date("n"), date("d"), date("Y"))),
                    '<=DATE_CREATE' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H")-$arParams['COUPON_TIME_LIFE']+24, date("i"), 0, date("n"), date("d"), date("Y"))),
                );

                $dbGetMessage = CSotbitMailingMessage::GetList(array(), $fillterMesssageGet, false, array('ID', 'PARAM_2', 'PARAM_MESSEGE'));
                while($resGetMessage = $dbGetMessage->Fetch())
                {
                    $resGetMessage['PARAM_MESSEGE'] = unserialize($resGetMessage['PARAM_MESSEGE']);
                    if($resGetMessage['PARAM_2'])
                    {
                        $arrCoupon[$resGetMessage['PARAM_2']] = $resGetMessage['PARAM_2'];
                    }
                    if($resGetMessage['PARAM_MESSEGE']['COUPON'])
                    {
                        $arrCoupon[$resGetMessage['PARAM_MESSEGE']['COUPON']] = $resGetMessage['PARAM_MESSEGE']['COUPON'];
                    }
                }
                //END

                //������� � ������ ��� ������������ ������ ������
                //START
                if(count($arrCoupon) > 0)
                {
                    $rsDiscountCoupon = CCatalogDiscountCoupon::GetList(
                        array(),
                        array(
                            'COUPON' => $arrCoupon,
                            'DISCOUNT_ID' => $arParams['COUPON_DISCOUNT_ID'],
                            'DATE_APPLY' => false,
                            '<=DATE_CREATE' => date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H")-$arParams['COUPON_TIME_LIFE'], date("i"), 0, date("n"), date("d"), date("Y")))
                        ),
                        false,
                        false,
                        array()
                    );

                    while($arrDiscountCoupon = $rsDiscountCoupon->Fetch())
                    {
                        if($arParams['COUPON_TIME_LIFE_ACTION'] == 'DELETE')
                        {
                            CCatalogDiscountCoupon::Delete($arrDiscountCoupon['ID']);
                        }
                        elseif($arParams['COUPON_TIME_LIFE_ACTION'] == 'DEACTION')
                        {
                            CCatalogDiscountCoupon::Update($arrDiscountCoupon['ID'], array('ACTIVE' => 'N'));
                        }
                    }
                }
                //END
            }
            //END
        }
        //END
    }

    /**
    * ����� - �����, ��������� ������������� � ������������, ������� ��� ������������ ������, ������� ������ �� ������������� 
    * 
    * @return string ��� ������������ ������ �������������� ������
    *
    */
    public function AgentMailingNeedAction()
    {
        global $USER;
        if(!is_object($USER))
        {
            $USER = new CUser();
        }

        CSotbitMailingTools::MailingNeedAction();

        return "CSotbitMailingTools::AgentMailingNeedAction();";
    }
}

?>