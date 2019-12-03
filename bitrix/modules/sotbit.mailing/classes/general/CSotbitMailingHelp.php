<?IncludeModuleLangFile(__FILE__);
use Bitrix\Main;
use Bitrix\Main\Mail;
use Bitrix\Main\SystemException;
use Bitrix\Main\Mail\Internal as MailInternal;
/**
* ��������������� ����� ������ sotbit.mailing
*
* ��������� ������:
* <ul>
* <li><b>EVENT_ADD_MAILING</b> - �������� ��������� ������� ��� ������</li>
* <li><b>MODULE_ID</b> - ������������� ������</li>
* <li><b>CACHE_TIME_TOOLS</b> - ����� �����������</li>
* </ul> 
*/     
class CSotbitMailingHelp { 
 
    CONST EVENT_ADD_MAILING = "SOTBIT_MAILING_EVENT_SEND";
    CONST MODULE_ID = "sotbit.mailing";
    CONST CACHE_TIME_TOOLS = 1800; 
   
 
    /**
    * ����� �������� ����������� ��� ����������, ���� � ���������� ������ sotbit.mailing ���������� �������������� ��������.
    * 
    * @return void
    *
    */
    public function CacheConstantCheck() { 
        if(COption::GetOptionString("sotbit.mailing", "MANAGED_CACHE_ON", "Y") == "Y")
        {
            define("BX_COMP_MANAGED_CACHE", true);
        } 
        elseif(COption::GetOptionString("sotbit.mailing", "MANAGED_CACHE_ON") == "N") 
        {
            define("BX_COMP_MANAGED_CACHE", false);    
        }        
    }
  
    //������� ������ �� ��������
    //START
    /**
    * ����� ���������� ���������� �� ����������� ���������.
    * 
    * ����� ���������� ���, ���� �� ��� �� �������, �� ��������� ������ �� ���� � �������� �� � ����.
    * 
    * @return array $vars ������ ������ �� ���������.
    *
    */
    public function GetMailingInfo() {
       
        CSotbitMailingHelp::CacheConstantCheck();
        
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetMailingInfo';
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetMailingInfo|';  
        if($obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             
           $vars = array();

           $select = array(
                'ID',
                'ACTIVE',
                'NAME',
                'MODE',
                'EVENT_TYPE',
                'COUNT_RUN',
                'SITE_URL',
                'USER_AUTH',
                'EVENT_SEND_SYSTEM',
                'EVENT_SEND_SYSTEM_CODE',
                'EXCLUDE_HOUR_AGO',
                'EXCLUDE_UNSUBSCRIBED_USER',
                'EXCLUDE_UNSUBSCRIBED_USER_MORE',
                'EVENT_PARAMS'
           );
           
           $resData = CSotbitMailingEvent::GetList(array('ID'=>'ASC'),array(),false,$select);
           while($arrData = $resData->Fetch()) {
                if($arrData['EVENT_PARAMS']){
                    $EVENT_PARAMS = unserialize($arrData['EVENT_PARAMS']); 
                    foreach($EVENT_PARAMS as $k=>$v){
                        $arrData['EVENT_PARAMS_'.$k] = $v;    
                    }    
                }                
                $vars[$arrData['ID']] = $arrData;                              
           }           
           
                     
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetMailingInfo');  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    }
    //END      
   
    //������� ������ �� ���������� ��������
    //START
    public function GetCategoriesInfo() {
        CSotbitMailingHelp::CacheConstantCheck();       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetCategoriesInfo';
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetCategoriesInfo|';  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             
           $vars = array();

           $resData = CSotbitMailingCategories::GetList(array('ID'=>'ASC'),array(),false, array());
           while($arrData = $resData->Fetch()) {
                $vars[$arrData['ID']] = $arrData;                
           }           
           
                     
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetCategoriesInfo');  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    }
    //END    
   
    //������� ������� ��������
    //START
    public function GetEventTemplate($ID_EVENT) {
        CSotbitMailingHelp::CacheConstantCheck();       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetEventTemplate_'.$ID_EVENT;
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetEventTemplate|'.$ID_EVENT;  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             
           $vars = array();

           $resData = CSotbitMailingMessageTemplate::GetList(array('COUNT_START'=>'DESC'),array('ID_EVENT' => $ID_EVENT) ,false,array()); 
           while($arrData = $resData->Fetch()) {
                $vars[$arrData['ID']] = $arrData;                
           }          
                  
                      
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetEventTemplate_'.$ID_EVENT);  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    }
    //END       

    //������� ������ email ��������� �� ������� ���� ���������� � ������������ ����������
    /**
    * ����� ���������� ������ email �������, �� ������� �������������� �������� ��������� � ������������ ���������� �������.
    * 
    * ��� ����� ������ ������ �� ���������� ���.
    * 
    * @param array $SETTING ������ �������� (���������� �������� ID_EVENT)  
    * 
    * @return array|boolean ������ �������, �� ������� �������������� �������� ��������� � ������������ ���������� �������, false - � ������ ���� �� ������� ID_EVENT ��� ���������� ����������� � 0 ����� 
    *
    */
    public function GetEmailSendMessageTimeNoCache($SETTING=array()) { 
        
        if(!isset($SETTING['ID_EVENT'])){
            return false;    
        }    
        $GetMailingInfo = CSotbitMailingHelp::GetMailingInfo();    
        $resEvent = $GetMailingInfo[$SETTING['ID_EVENT']];
        
        
        if($resEvent['EXCLUDE_HOUR_AGO']==0){
            return false;                  
        }
        
        $vars = array();
        //������� ����
        $mkNow = mktime(date('H'),date('i')+20,date('s'),date('m'),date('j'),date('Y'));  
        $mkAgo = mktime(date('H')-$resEvent['EXCLUDE_HOUR_AGO'],date('i')-20,date('s'),date('m'),date('j'),date('Y'));  
        $FillterMessage = array(
            "ID_EVENT" => $resEvent['ID'],
            ">=DATE_CREATE" => date('d.m.Y H:i:s', $mkAgo),     
            "<=DATE_CREATE" => date('d.m.Y H:i:s', $mkNow)
        );


        ###############################
        if(isset($SETTING['COUNT_RUN'])){
            $FillterMessage['<=COUNT_RUN'] = $SETTING['COUNT_RUN'];
        }
        ###############################
        //����� ������ �� ������ � ��������
        if($resEvent['EVENT_PARAMS_EXCLUDE_DAYS_HOUR_MODE']=='LIST'){
            $FillterMessage['ID_EVENT'] = array($resEvent['ID']);    
            foreach($resEvent['EVENT_PARAMS_EXCLUDE_HOUR_AGO_EVENT'] as $k=>$v){
                $FillterMessage['ID_EVENT'][] = $v;    
            }      
        }//����� ������ �� ����
        elseif($resEvent['EVENT_PARAMS_EXCLUDE_DAYS_HOUR_MODE']=='ALL'){ 
            unset($FillterMessage['ID_EVENT']);     
        }
            
            
        $resData = CSotbitMailingMessage::GetList(array(),$FillterMessage,false,array('ID','EMAIL_TO','DATE_SEND'));
        while($arrData = $resData->Fetch()) {
            $arrData['EMAIL_TO'] = trim($arrData['EMAIL_TO']);
            $vars[$arrData['EMAIL_TO']] = $arrData['ID'];                
        }      
          
        return $vars;                  
    }
    
    //������� ������ email ��������� �� ������� ���� ���������� � ������������ ���������� � �����
    //START
    public function GetEmailSendMessageTime($SETTING=array()) {
        
        $ID_EVENT = $SETTING['ID_EVENT'];
        $COUNT_RUN = $SETTING['COUNT_RUN'];
        $EXCLUDE_HOUR_AGO = $SETTING['EXCLUDE_HOUR_AGO'];
        
        CSotbitMailingHelp::CacheConstantCheck();
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetEmailSendMessageTime_'.$ID_EVENT.'_'.$COUNT_RUN;
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetEmailSendMessageTime|'.$ID_EVENT.'|'.$COUNT_RUN;  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);  
                
           $vars = array();
           $vars = CSotbitMailingHelp::GetEmailSendMessageTimeNoCache($SETTING);
                   
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetEmailSendMessageTime_'.$ID_EVENT.'_'.$COUNT_RUN);  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }    
   
          
        return $vars;      
        
    }
    //END 
         
   
    //������� �������� �� ID
    //START
    public function GetSiteId() {
        CSotbitMailingHelp::CacheConstantCheck();       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetSiteId';
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetSiteId|';  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif(CModule::IncludeModule("iblock") && $obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             
           $vars = array();

           $rsSites = CSite::GetList($by="sort", $order="desc", Array());
           while ($arS = $rsSites->Fetch())
           {
                $vars[] = $arS['LID'];  
           }              
           
           
                     
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetSiteId');  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    }
    //END     
   
     
   
   
    // ������� ������ ������������ �� �������� - ��� ����
    //START
    /**
    * ����� ���������� ������ email �������, ������� ���� �������� �� ��������, ������������� ������� ��� ������� � �����.
    * 
    * ��� ����� ������ ������ �� ���������� ���.
    * 
    * @param string $ID_EVENT ������������� �������, ��� ������� ��������� �������� ������������ email
    * 
    * @return array ������ �������, ������� ���� �������� �� �������� 
    *
    */
    public function GetUnsubscribedByMailing_NoCache($ID_EVENT=false) { 

        $vars = array();
        $resSearch = CSotbitMailingUnsubscribed::GetList(array(), array('ID_EVENT' => $ID_EVENT, "ACTIVE" => "Y"), false, array('ID','EMAIL_TO'));
        while ($arrSearch = $resSearch->Fetch())
        {
            $arrSearch['EMAIL_TO'] = trim($arrSearch['EMAIL_TO']);
            $vars[$arrSearch['EMAIL_TO']] = $arrSearch['ID'];  
        }   
        
        return $vars;

    }    
    //END   
    // ������� ������ ������������ �� ��������
    // START
    public function GetUnsubscribedByMailing($ID_EVENT=false) {
        CSotbitMailingHelp::CacheConstantCheck();                       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetUnsubscribedByMailing_'.$ID_EVENT;
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetUnsubscribedByMailing|'.$ID_EVENT;  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             
 
           $vars = array();
           $vars = CSotbitMailingHelp::GetUnsubscribedByMailing_NoCache($ID_EVENT);            
                   
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetUnsubscribedByMailing_'.$ID_EVENT);  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    } 
    // END   
        
           
    //������� ������ ������������ �� ���� ��������� - ��� ����
    //START
    /**
    * ����� ���������� ������ email �������, ������� ���� �������� �� ���� ���������.
    * 
    * ��� ����� ������ ������ �� ���������� ���.
    * 
    * @return array ������ �������, ������� ���� �������� �� ���� ��������� 
    *
    */
    public function GetUnsubscribedAllMailing_NoCache() { 

        $vars = array();
        $resSearch = CSotbitMailingUnsubscribed::GetList(array(), array("ACTIVE" => "Y"), false, array('ID','EMAIL_TO'));
        while ($arrSearch = $resSearch->Fetch())
        {
            $arrSearch['EMAIL_TO'] = trim($arrSearch['EMAIL_TO']);               
            $vars[$arrSearch['EMAIL_TO']] = $arrSearch['ID'];  
        }   
        
        return $vars;

    }    
    //END              
    // ������� ������ ������������ ���� ���������
    // START
    public function GetUnsubscribedAllMailing() {
        CSotbitMailingHelp::CacheConstantCheck();       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetUnsubscribedAllMailing';
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetUnsubscribedAllMailing|';  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             

           
           $vars = array();
           $vars = CSotbitMailingHelp::GetUnsubscribedAllMailing_NoCache();           
                      
                   
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetUnsubscribedAllMailing');  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    } 
    // END

    
    //������� ������ ������ �� ������� �� ���� ���������� - ��� ����
    //START
    /**
    * ����� ���������� ������ email �������, ��������� �� ������� �� ���� ����������.
    * 
    * ��� ����� ������ ������ �� ���������� ���.
    * 
    * @return array ������ �������, ��������� �� ������� �� ���� ���������� 
    *
    */
    public function GetUndeliveredMailing_NoCache() { 

        $vars = array();
        $resSearch = CSotbitMailingUndelivered::GetList(array(), array("ACTIVE" => "Y"), false, array('ID','EMAIL_TO'));
        while ($arrSearch = $resSearch->Fetch())
        {
            $arrSearch['EMAIL_TO'] = trim($arrSearch['EMAIL_TO']);               
            $vars[$arrSearch['EMAIL_TO']] = $arrSearch['ID'];  
        }   
        
        return $vars;

    }    
    //END              
    // ������� ������ ������������ ���� ���������
    // START
    public function GetUndeliveredMailing() {
        CSotbitMailingHelp::CacheConstantCheck();       
        $obCache = new CPHPCache();
        $cache_dir = '/'.self::MODULE_ID.'_GetUndeliveredMailing';
        //$cache_dir = '/'.self::MODULE_ID;  
        $cache_id = self::MODULE_ID.'|GetUndeliveredMailing|';  
        if( $obCache->InitCache(self::CACHE_TIME_TOOLS,$cache_id,$cache_dir))// ���� ��� �������
        {
           $vars = $obCache->GetVars();// ���������� ���������� �� ����   
        }
        elseif($obCache->StartDataCache())// ���� ��� ���������
        {     
           global $CACHE_MANAGER;
           $CACHE_MANAGER->StartTagCache($cache_dir);             

           
           $vars = array();
           $vars = CSotbitMailingHelp::GetUndeliveredMailing_NoCache();           
                      
                   
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID.'_GetUndeliveredMailing');  
           $CACHE_MANAGER->RegisterTag(self::MODULE_ID);  
           $CACHE_MANAGER->EndTagCache();           
               
           $obCache->EndDataCache($vars);// ��������� ���������� � ���.   
        }      
        return $vars;      
    } 
    // END    
    
    //������� ��� ��������� ���� �� ��������� �������
    /**
    * ����� ����������� ��������� �������� � �������, ����, ����� ��� ������� � ��� ���� � ������ ������� � ���� "��" � "��" ������������ ������� ����.
    * 
    * @param array $arFields ������ ���������� �������� "from", "to" � "type", ��� "type" - ������� ��������� ���������, � "from" � "to" - ������������� ��� ��������
    * 
    * @return array ������ ���������� ���� "��" � "��" ������������ �������.
    *
    */
    public function GetDateAgoNow($arFields) {
        
        if(!isset($arFields['from']) || !isset($arFields['to']) || !isset($arFields['type'])){
            return false;    
        }
        global $DB; 
        $result = array(); 
        //�����
        if($arFields['type']=='MIN'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i")-$arFields['from'], 0,  date("n"), date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i")-$arFields['to'], 0,  date("n"), date("d"), date("Y")));    
        }        
        elseif($arFields['type']=='HOURS'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H")-$arFields['from'], date("i"), 0,  date("n"), date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H")-$arFields['to'], date("i"), 0,  date("n"), date("d"), date("Y")));             
        }   
        elseif($arFields['type']=='DAYS'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n"), date("d")-$arFields['from'], date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n"), date("d")-$arFields['to'], date("Y")));              
        }  
        elseif($arFields['type']=='MONTH'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n")-$arFields['from'], date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n")-$arFields['to'], date("d"), date("Y")));               
        }  
        //������
        elseif($arFields['type']=='MIN_FORWARD'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i")+$arFields['to'], 0,  date("n"), date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i")+$arFields['from'], 0,  date("n"), date("d"), date("Y")));    
        }        
        elseif($arFields['type']=='HOURS_FORWARD'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H")+$arFields['to'], date("i"), 0,  date("n"), date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H")+$arFields['from'], date("i"), 0,  date("n"), date("d"), date("Y")));             
        }   
        elseif($arFields['type']=='DAYS_FORWARD'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n"), date("d")+$arFields['to'], date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n"), date("d")+$arFields['from'], date("Y")));              
        }  
        elseif($arFields['type']=='MONTH_FORWARD'){
            $result['to'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n")+$arFields['to'], date("d"), date("Y")));    
            $result['from'] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")),  mktime(date("H"), date("i"), 0,  date("n")+$arFields['from'], date("d"), date("Y")));               
        }        
        
        
          
        
        return $result;              
                        
    }   
    
    
   
    // �������� � �������� ��� ��������� �������
    // START
    /**
    * ����� ��������� ������� � ������� ���������� ��������� �������, ������� ���, ���� ��� �� �������.
    * 
    * ��� ��������� ������� ������� �� ��������� EVENT_ADD_MAILING, ���� ������� �����������,
    * �� ��� ��������� � ����� ����������� � ���� �������� ������ � ������������ ����������� � �������� �������� �����.
    * 
    * @param string $EVENT_TYPE �������������� �������� - ��� �������, �� ��������� - false 
    * 
    * @return string �������� ��������� �������
    *
    */
    public function EventMessageCheck($EVENT_TYPE=false) {
        
        if(empty($EVENT_TYPE)){
            $EVENT_TYPE = self::EVENT_ADD_MAILING;    
        }
        
        $arFilter = array(
            "TYPE_ID" => $EVENT_TYPE,
            "LID"     => "ru"
        );
        $arET = CEventType::GetList($arFilter)->Fetch();

        if(!$arET)
        {
            
            $arrSite = array();
            $rsSites = CSite::GetList($by="sort", $order="desc", Array());
            while ($arS = $rsSites->Fetch())
            {
                $arrSite[] = $arS['LID'];  
            }            
            
            $et = new CEventType;
            $et->Add(array(
                "LID"           => "ru",
                "EVENT_NAME"    => $EVENT_TYPE,
                "NAME"          => GetMessage(self::MODULE_ID.'_EVENT_NAME'),
                "DESCRIPTION"   => ''
            ));
            $arFields = array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => $EVENT_TYPE,
                "LID" => $arrSite,
                "EMAIL_FROM" => "#EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => "#SUBJECT#",
                "BODY_TYPE" => "html",
                "MESSAGE" => "#MESSEGE#"
            );//return;
            $mes = new CEventMessage;
            $mesID = $mes->Add($arFields);
            
            return $EVENT_TYPE;
        }  
        return $arET['EVENT_NAME'];      
    }
    // END
    
    /**
    * ����� ���������� ������ ��������������� ���� ������, ��������� � �������.
    * 
    * @return array ������ ��������������� ���� ������.
    *
    */
    protected function getSitesArr()
    {
        $arrSite = array();
        $rsSites = CSite::GetList($by="sort", $order="desc", Array());
        while ($arS = $rsSites->Fetch())
        {
            $arrSite[] = $arS['LID'];  
        }
        return  $arrSite;
    }
    
    /**
    * ����� ������� ����� �������� ������, � ��������� � �������, ����������� � ��������� $EVENT_TYPE.
    * 
    * @param string $EVENT_TYPE ��� ��������� �������, ��� �������� ���������� ������� ������
    * @param array $templateParams �������������� ������ ���������� ��������� �������
    * 
    * @return string|boolean ������������� ���������� ��������� ������� ��� false, � ������ ���� ������� ������ ��������
    *
    */
    public function CreateEventMessage($EVENT_TYPE, $templateParams = array())
    {
        if (empty($EVENT_TYPE)) {
            return false;
        }
        $arrSite = $this->getSitesArr();
        
        $arFields = array(
            "ACTIVE" => "Y",
            "EVENT_NAME" => $EVENT_TYPE,
            "LID" => $arrSite,
            "EMAIL_FROM" => "#EMAIL_FROM#",
            "EMAIL_TO" => "#EMAIL_TO#",
            "BCC" => '',
            "SUBJECT" => "#SUBJECT#",
            "BODY_TYPE" => "html",
            "MESSAGE" => "#MESSEGE#",
            "SITE_TEMPLATE_ID" => "",
        );
        
        if (!empty($templateParams)) {
            foreach ($templateParams as $key => $value) {
                $arFields[$key] =  $value;
            }
        }
        
        $mes = new CEventMessage;
        $mesID = $mes->Add($arFields);
        return $mesID;
    }
    
    /**
    * ����� ��������� ������������ �������� ������
    * 
    * @param string $eventMessageId ������������� ��������� �������
    * @param array $templateParams ������ ���������� ��������� �������
    * 
    * @return boolean true ���� ��������� ������ ������� (��� ��������� �� �����������), false ���� � �������� ���������� ��������� ������
    *
    */
    public function UpdateEventMessage($eventMessageId, $templateParams = array())
    {
        if (empty($eventMessageId)) {
            return false;
        }
        
        if (!empty($templateParams)) {
           $eventMessage = new CEventMessage;
           $res = $eventMessage->Update($eventMessageId, $templateParams);
           return $res;
        }
        
        return true;
    }
    
    /**
    * ����� ������� � ������� ����� ��� ��������� ������� � ��������� ������.
    * 
    * ���� � ������� ��� ������� ������� � ����� ������, �� ����� ������� �������������� �� �����
    * 
    * @param string $mailingId  - ������������� �������� �������� �������� 
    * @param string $name  - �������� ��������� ������� 
    * 
    * @return string ��� ���������� ��������� �������
    *
    */
    public function CreateEventType($mailingId, $name = '')
    {
        $eventTypeName = 'SOTBIT_MAILING_EVENT_' . $mailingId;
        //���������� �� ����� ��� ������� � �������?
            $arEventTypeFilter = array(
            "TYPE_ID" => $eventTypeName,
            );
            $rsET = CEventType::GetList($arEventTypeFilter);
            $arET = $rsET->Fetch();
            if (!empty($arET))
            {
                //���� ����� ������� ��� ���������� � �������, �� ������ ��� ���
                return  $eventTypeName;
            }
            
          //������� ��� ��������� ������� � ����� ������
            $et = new CEventType;
            $et->Add(array(
                 "LID"           => "ru",
                 "EVENT_NAME"    => $eventTypeName,
                 "NAME"          => $name,
                 "DESCRIPTION"   => '',
            ));
            return  $eventTypeName;            
    }
    
    /**
    * ����� ����������� ��������� � ������� bitrix � ���������� ��� ����������.
    * 
    * @param string $event  - ��� ��������� ������� 
    * @param array $arFields  - ������ ����� ��� ����������� � ������ 
    * @param string $message_id  - ������������� ��������� ������� 
    * 
    * @return string ����� ����������������� ���������
    *
    */
    public function CompileMessageText($event, $arFields, $message_id)
    {
        $lid = $this->getSitesArr();
        $Duplicate = "N";
        $files = array();
        $languageId = '';
        
        if(!is_array($arFields))
        {
            $arFields = array();
        }

        $arEvent = array(
            "EVENT_NAME" => $event,
            "C_FIELDS" => $arFields,
            "LID" => (is_array($lid)? implode(",", $lid) : $lid),
            "DUPLICATE" => ($Duplicate != "N"? "Y" : "N"),
            "MESSAGE_ID" => (intval($message_id) > 0? intval($message_id): ""),
            "DATE_INSERT" => GetTime(time(), "FULL"),
            "FILE" => $files,
            "LANGUAGE_ID" => ($languageId == ''? LANGUAGE_ID : $languageId),
            "ID" => "0",
        );

        //���������� ������ ��� ���������� ������
        if(!isset($arEvent['FIELDS']) && isset($arEvent['C_FIELDS']))
            $arEvent['FIELDS'] = $arEvent['C_FIELDS'];

        $arSites = explode(",", $arEvent["LID"]);

        $charset = false;
        $serverName = null;
        $siteDb = Main\SiteTable::getList(array(
            'select'=>array('SERVER_NAME', 'CULTURE_CHARSET'=>'CULTURE.CHARSET'),
            'filter' => array('LID' => $arSites)
        ));
        if($arSiteDb = $siteDb->fetch())
        {
            $charset = $arSiteDb['CULTURE_CHARSET'];
            $serverName = $arSiteDb['SERVER_NAME'];
        }

        // get filter for list of message templates
        $arEventMessageFilter = array();
        $MESSAGE_ID = intval($arEvent["MESSAGE_ID"]);
        if($MESSAGE_ID > 0)
        {
            $eventMessageDb = MailInternal\EventMessageTable::getById($MESSAGE_ID);
            if($eventMessageDb->Fetch())
            {
                $arEventMessageFilter['ID'] = $MESSAGE_ID;
                $arEventMessageFilter['ACTIVE'] = 'Y';
            }
        }
        if(count($arEventMessageFilter)==0)
        {
            $arEventMessageFilter = array(
                'ACTIVE' => 'Y',
                'EVENT_NAME' => $arEvent["EVENT_NAME"],
                'EVENT_MESSAGE_SITE.SITE_ID' => $arSites,
            );
        }

        // get list of message templates of event
        $messageDb = MailInternal\EventMessageTable::getList(array(
            'select' => array('ID'),
            'filter' => $arEventMessageFilter,
            'group' => array('ID')
        ));

        while($arMessage = $messageDb->fetch())
        {
            $eventMessage = MailInternal\EventMessageTable::getRowById($arMessage['ID']);
            $eventMessage['FILES'] = array();
            $attachmentDb = MailInternal\EventMessageAttachmentTable::getList(array(
                'select' => array('FILE_ID'),
                'filter' => array('EVENT_MESSAGE_ID' => $arMessage['ID']),
            ));
            while($arAttachmentDb = $attachmentDb->fetch())
            {
                $eventMessage['FILE'][] = $arAttachmentDb['FILE_ID'];
            }


            $arFields = $arEvent['FIELDS'];
            
            $arMessageParams = array(
                'EVENT' => $arEvent,
                'FIELDS' => $arFields,
                'MESSAGE' => $eventMessage,
                'SITE' => $arSites,
                'CHARSET' => $charset,
            );
            //���������� ���������
            $message = Mail\EventMessageCompiler::createInstance($arMessageParams);
            $message->compile();
            //���������� ����� ���������
            return $message->getMailBody();
        }
    }
    
    /**
    * ����� ��������� ������� � ������� ���������� ��������� ������� � ������� ��������� ������� ��� ����, ������� ��, ���� �� ����������.
    * 
    * ������ ����� �������� $this->EventMessageCheck() ����� ��������� ������� �������� ���� ��������� �������.
    * 
    * @param string $EVENT_TYPE  - ��� ������� 
    * @param string $MAILING_NAME  - �������� �������� �������� �������� 
    * 
    * @return string|boolean ������������� ��������� �������, ������������ � ������� ��� false, ���� �� ������� �������� $EVENT_TYPE
    *
    */
    public function EventTemplateCheck($EVENT_TYPE, $MAILING_NAME = '') {
        //�������� � �������� ������� ��� ��������� ������� � �������� ������ ��� �������� ���� ��������� ������
        $this->EventMessageCheck();
        
        if (empty($EVENT_TYPE)) {
            return false;
        }
        //���������� �� ������ ��� ��������� ������� � �������?
        $arEventTypeFilter = array(
            "TYPE_ID" => $EVENT_TYPE,
            "LID"     => "ru",
        );
        
        $arET = CEventType::GetList($arEventTypeFilter)->Fetch();
        
        //���� ��� ����������, ��������� �������� �� � ���� �������� ������
        if ($arET) {
            $arEventMessageFilter = Array(
                "TYPE_ID" => $EVENT_TYPE,
            );
            
        $rsEventMessage = CEventMessage::GetList($by="id", $order="asc", $arEventMessageFilter);
        $arEventMessage = $rsEventMessage->Fetch();
        //���� ������ ����������, ���������� ��� id
            if ($arEventMessage) {
                return $arEventMessage['ID'];
            }
            else {
                //����� ������� �������� ������ ��� ������� ���� �������
                $mesId = $this->CreateEventMessage($EVENT_TYPE);
                return $mesId; 
            }
        }
        else
        {
            //���� ��� �� ����������, �������� ��� � �������� � ���� �������� ������
            $et = new CEventType;
            
            $id = $et->Add(array(
                "LID"           => "ru",
                "EVENT_NAME"    => $EVENT_TYPE,
                "NAME"          => $MAILING_NAME,
                "DESCRIPTION"   => ''
            ));
            //�������� �������
            $mesId = $this->CreateEventMessage($EVENT_TYPE);
            return $mesId;
        }
    }
    
    /**
    * ����� ���������� ������ ������ � ������ ��������� �������.
    * 
    * @param string $messageText  - ����� ��������� � ������� ��������� ���������� ������ ������ 
    * @param string $siteUrl  - URL �����, ������� ����� ����������� � ������� 
    * 
    * @return string|boolean ����� ��������� � ����������� �������� ��� false � ������ ��������� ������� ����������
    *
    */
    public function ReplaceTemplateLinks($messageText, $siteUrl = '') {
        if(empty($messageText)) {
            return false;
        }
        
        //������� ������ � ������
        $str = $messageText;
        $arr_link = array();
        $reg = '#href=([\'"]?)((?(?<![\'"])[^>\s]+|.+?(?=\1)))\1#si';
        if(preg_match_all($reg, $str, $find)) {
            //������ ������ �� ������� ������
            foreach($find['2'] as $k=>$v){

                if(strpos($v,'MAILING_MESSAGE')){
                    unset($find['2'][$k]);
                    unset($find['1'][$k]);    
                    unset($find['0'][$k]);        
                }    
                if(strpos($v,'@')){
                    unset($find['2'][$k]);  
                    unset($find['1'][$k]);    
                    unset($find['0'][$k]);      
                }
                if($v=="#"){
                    unset($find['2'][$k]); 
                    unset($find['1'][$k]);    
                    unset($find['0'][$k]);       
                }                                    
            }
            $arr_link = $find['2']; 
        }      
        
        
        //������� �������� ������
        $parse_url_mailing =  parse_url($siteUrl);
        //�������� ������ �� ������  
        $arr_link_need = array();
        foreach($arr_link as $k=>$v){    

            $parse_url =  parse_url($v);
            if($parse_url['host']!=$parse_url_mailing['host']){
                $arr_link_need[$k] = 'href='.$find[1][$k].$siteUrl.'/?MAILING_MESSAGE=#MAILING_MESSAGE#&utm_source=newsletter&utm_medium=email&utm_campaign=sotbit_mailing_#MAILING_EVENT_ID#&MAILING_FILE_REDURECT='.$v.$find[1][$k];        
            } 
            else {
                if(strpos($v,'?')){
                    $arr_link_need[$k] = 'href='.$find[1][$k].$v.'&MAILING_MESSAGE=#MAILING_MESSAGE#&utm_source=newsletter&utm_medium=email&utm_campaign=sotbit_mailing_#MAILING_EVENT_ID#'.$find[1][$k];    
                } else {
                    $arr_link_need[$k] = 'href='.$find[1][$k].$v.'?MAILING_MESSAGE=#MAILING_MESSAGE#&utm_source=newsletter&utm_medium=email&utm_campaign=sotbit_mailing_#MAILING_EVENT_ID#'.$find[1][$k];                   
                }             
            } 
            
            
        }
        //������� ������
        foreach($find[0] as $k=>$v){
            $messageText = str_replace($v, $arr_link_need[$k], $messageText);           
        }
        
        return $messageText;
    }
    
    
    //������� ������� ������ ��������� �� �������
    //START
    /**
    * ����� ��������� ������������ �����, ��������� �� �������� ������������ email, ������������ �������� ��������.
    * 
    * - ����� �������� ���� �� ���������� ����� �� ������� ������������ � ���������� ��������
    * - ���� �������� �� ���������� ������
    * - �������� �� ������ � ������ �������������
    * - ���� �������� ��������
    *    - ������� ������ �� ������� ����������
    *    - ������� ������ �� ������� ��� ���� ��������
    *    - ����������� ���������������� ������ $arrEmailSend
    * 
    * @param array $SETTING ������ ���������� �������� arParams - ��������� �������� � $arrEmailSend - ������ ��������� ��� �������� 
    * 
    * @return array ���������������� ������ ��������� ��� ���������
    *
    */    
    public function MessageCheck($SETTING) {
        
        $arParams = $SETTING['arParams'];
        $arrEmailSend = $SETTING['arrEmailSend'];     
        $COUNT_ALL = count($arrEmailSend); 
                           
           
        if(empty($arParams["MAILING_EVENT_ID"]) && empty($arParams['MAILING_COUNT_RUN'])){
             $arrEmailSend = array();  
             return $arrEmailSend;                
        }
        
        $arrProgress = CSotbitMailingHelp::ProgressFileGetArray($arParams["MAILING_EVENT_ID"], $arParams['MAILING_COUNT_RUN']);   
        $arrProgress['COUNT_ALL'] = $COUNT_ALL;
       
        // ���� �� ���������� ����� �� ��������
        // START 
            //�� ������� ������������ � ���������� ��������
            if($arParams['MAILING_EXCLUDE_HOUR_AGO'] != 0) { 
                $setting_HourAgoEmail = array(
                    'ID_EVENT'=> $arParams['MAILING_EVENT_ID'],
                    'COUNT_RUN'=> $arParams['MAILING_COUNT_RUN']   ###############################
                );
                $DubleThisMailing = array();
                $HourAgoEmail = CSotbitMailingHelp::GetEmailSendMessageTimeNoCache($setting_HourAgoEmail);   
                $arrProgress_EMAIL_TO_EXCLUDE_HOUR_AGO = 0;
                $EMAIL_TO_EXCLUDE_HOUR_AGO_INFO = '';
                foreach($arrEmailSend as $k => $ItemEmailSend) { 
                    $EmailSend = array();
                    $EmailSend['EMAIL_TO'] = CSotbitMailingHelp::ReplaceVariables($arParams["EMAIL_TO"] , $ItemEmailSend);  
                    $EmailSend['EMAIL_TO'] = trim($EmailSend['EMAIL_TO']);
                    if($HourAgoEmail[$EmailSend['EMAIL_TO']]){
                        $EMAIL_TO_EXCLUDE_HOUR_AGO_INFO .=  $EmailSend['EMAIL_TO']."\n";
                        $arrProgress_EMAIL_TO_EXCLUDE_HOUR_AGO++;
                        //unset($arrEmailSend[$k]); 
                        $arrEmailSend[$k]['isContinue'] = 'Y';  
                    } elseif($DubleThisMailing[$EmailSend['EMAIL_TO']]) {
                        $EMAIL_TO_EXCLUDE_HOUR_AGO_INFO .=  $EmailSend['EMAIL_TO']."\n";
                        $arrProgress_EMAIL_TO_EXCLUDE_HOUR_AGO++;
                        //unset($arrEmailSend[$k]); 
                        $arrEmailSend[$k]['isContinue'] = 'Y';                          
                    }
                    $DubleThisMailing[$EmailSend['EMAIL_TO']] = $EmailSend['EMAIL_TO'];

                }  
                
                if($EMAIL_TO_EXCLUDE_HOUR_AGO_INFO){
                    $arrProgress_more['EMAIL_TO_EXCLUDE_HOUR_AGO_INFO'] = $EMAIL_TO_EXCLUDE_HOUR_AGO_INFO;                    
                }
                $arrProgress['EMAIL_TO_EXCLUDE_HOUR_AGO'] =  $arrProgress_EMAIL_TO_EXCLUDE_HOUR_AGO;        
            }
        //END   
 
 
        //�������� �������� �� ���������� ������ ������ ���� ����� ���� � ������
        //START   
        if($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER'] == 'ALL') {
            $UnsubscribeEmail = CSotbitMailingHelp::GetUnsubscribedAllMailing_NoCache();  
        } 
        elseif($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER'] == 'THIS') {
            $UnsubscribeEmail = CSotbitMailingHelp::GetUnsubscribedByMailing_NoCache($arParams["MAILING_EVENT_ID"]);  
            //������� ������ �� ������� 
            foreach($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER_MORE'] as $event_id) {
                $UnsubscribeEmailMore = CSotbitMailingHelp::GetUnsubscribedByMailing_NoCache($event_id);        
                $UnsubscribeEmail = array_merge($UnsubscribeEmail,$UnsubscribeEmailMore); 
            }
                 
        }
        //�������� �������� ������
        $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED = 0;
        $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO = '';
        foreach($arrEmailSend as $k => $ItemEmailSend) { 
            $EmailSend = array();
            $EmailSend['EMAIL_TO'] = CSotbitMailingHelp::ReplaceVariables($arParams["EMAIL_TO"] , $ItemEmailSend);  
            $EmailSend['EMAIL_TO'] = trim($EmailSend['EMAIL_TO']);
            if($UnsubscribeEmail[$EmailSend['EMAIL_TO']]){
                $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO .=  $EmailSend['EMAIL_TO']."\n";
                $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED++;
                //unset($arrEmailSend[$k]);   
                $arrEmailSend[$k]['isContinue'] = 'Y'; 
            }
        }  
        
        if($EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO){
            $arrProgress_more['EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO'] = $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO;            
        }
        $arrProgress['EMAIL_TO_EXCLUDE_UNSUBSCRIBED'] =  $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED;                   
        //END         
        
        
        //�������� �������� �� ���������� ������ ������ ���� ����� ���� � ������
        //START   
        if($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER'] == 'ALL') {
            $UnsubscribeEmail = CSotbitMailingHelp::GetUnsubscribedAllMailing_NoCache();  
        } 
        elseif($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER'] == 'THIS') {
            $UnsubscribeEmail = CSotbitMailingHelp::GetUnsubscribedByMailing_NoCache($arParams["MAILING_EVENT_ID"]);  
            //������� ������ �� ������� 
            foreach($arParams['MAILING_EXCLUDE_UNSUBSCRIBED_USER_MORE'] as $event_id) {
                $UnsubscribeEmailMore = CSotbitMailingHelp::GetUnsubscribedByMailing_NoCache($event_id);        
                $UnsubscribeEmail = array_merge($UnsubscribeEmail,$UnsubscribeEmailMore); 
            }
                 
        }
        //�������� �������� ������
        $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED = 0;
        $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO = '';
        foreach($arrEmailSend as $k => $ItemEmailSend) { 
            $EmailSend = array();
            $EmailSend['EMAIL_TO'] = CSotbitMailingHelp::ReplaceVariables($arParams["EMAIL_TO"] , $ItemEmailSend);  
            $EmailSend['EMAIL_TO'] = trim($EmailSend['EMAIL_TO']);
            if($UnsubscribeEmail[$EmailSend['EMAIL_TO']]){
                $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO .=  $EmailSend['EMAIL_TO']."\n";
                $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED++;
                //unset($arrEmailSend[$k]);   
                $arrEmailSend[$k]['isContinue'] = 'Y'; 
            }
        }  
        
        if($EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO){
            $arrProgress_more['EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO'] = $EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO;            
        }
        $arrProgress['EMAIL_TO_EXCLUDE_UNSUBSCRIBED'] =  $arrProgress_EMAIL_TO_EXCLUDE_UNSUBSCRIBED;                   
        //END
        
        

        //�������� �������� �� ������ � ������ �������������
        //START   
        $UndeliveredEmail = CSotbitMailingHelp::GetUndeliveredMailing_NoCache();  
       
        //�������� �������� ������
        $arrProgress_EMAIL_TO_EXCLUDE_UNDELIVERED = 0;
        $EMAIL_TO_EXCLUDE_UNDELIVERED_INFO = '';
        foreach($arrEmailSend as $k => $ItemEmailSend) { 
            $EmailSend = array();
            $EmailSend['EMAIL_TO'] = CSotbitMailingHelp::ReplaceVariables($arParams["EMAIL_TO"] , $ItemEmailSend);  
            $EmailSend['EMAIL_TO'] = trim($EmailSend['EMAIL_TO']);
            if($UndeliveredEmail[$EmailSend['EMAIL_TO']]){
                $EMAIL_TO_EXCLUDE_UNDELIVERED_INFO .=  $EmailSend['EMAIL_TO']."\n";
                $arrProgress_EMAIL_TO_EXCLUDE_UNDELIVERED++;
                //unset($arrEmailSend[$k]);   
                $arrEmailSend[$k]['isContinue'] = 'Y'; 
            }
        }  
        
        if($EMAIL_TO_EXCLUDE_UNDELIVERED_INFO){
            $arrProgress_more['EMAIL_TO_EXCLUDE_UNDELIVERED_INFO'] = $EMAIL_TO_EXCLUDE_UNDELIVERED_INFO;            
        }
        $arrProgress['EMAIL_TO_EXCLUDE_UNDELIVERED'] =  $arrProgress_EMAIL_TO_EXCLUDE_UNDELIVERED;                   
        //END
        
        
        //�������� ��������
        //START   
            
        //������ �� ������ �� ������� ����������
        foreach($arrEmailSend as $k => $ItemEmailSend){ 
            if($arrEmailSend[$k]['isContinue']=='Y') {
                unset($arrEmailSend[$k]); 
                $arrProgress['COUNT_ALL'] = $arrProgress['COUNT_ALL']-1;   
            }    
        }
                    
            
        //������ ������ �� ������� ��� ���������     
        $c=0;
        foreach($arrEmailSend as $k => $ItemEmailSend){
            $c++; 
            if($c>=$arParams['MAILING_MAILING_WORK_COUNT']){
                break;    
            } else{
                unset($arrEmailSend[$k]);
            }           
        } 
        
         
        //END          
        
        if($arrProgress['COUNT_ALL']==0){
            $arrProgress['COUNT_ALL'] = 0;
            $arrProgress['COUNT_NOW'] = 0;
            $arrProgress['COUNT_SEND'] = 0;   
        }        
        
        
        CSotbitMailingHelp::ProgressFile($arParams["MAILING_EVENT_ID"], $arParams['MAILING_COUNT_RUN'], $arrProgress, $arrProgress_more);     
                
        
        return $arrEmailSend;  
        
    }   
    //END
    
    //������� ��� ������� � UniSender
    //START
    public function QueryUniSender($Metod=false, $Fields=array())
    {
        
       // �������� ����
       $data = array(
          'api_key' => COption::GetOptionString('sotbit.mailing', 'UNSENDER_API_KEY'),
          'format' => 'json',
          'double_optin' => '1'
       );
       
       // ��������� ������
       if(is_array($Fields)) {
           $data = array_merge($data,$Fields);           
       }  
       

       // ������� ������ 
       $postdata = http_build_query($data);   
       $Response = QueryGetData(
            'api.unisender.com',
            80,
            '/ru/api/'.$Metod.'?',
            $postdata,
            $error_number,
            $error_text ,
            'POST'
        );       
        $arrResponse = json_decode($Response,true);    
              
        return $arrResponse;    
    }      
    //END
    
    
    //������� ��������� �� Uniseder
    //START
    public function UniSenderExportContact($CATEGORIES_ID, $LIST_UNISENDER)
    {
        
        $arrayUser = array();
        $iteration = 500;
        $d = 0;
        //������� ������
        while($d <= 1000000)
        {
            
             $arrUniseder = array(
                'list_id' => $LIST_UNISENDER,
                'limit' => $iteration,
                'offset' => $d
            );
            $ExportList = CSotbitMailingHelp::QueryUniSender('exportContacts',$arrUniseder);    
            foreach($ExportList['result']['data'] as $item) {
                
                $arrayUser[] = array(
                    'EMAIL_TO' => $item[0],
                    'CATEGORIES_ID' => array($CATEGORIES_ID)
                );   
                $d++;         
            } 
            if(count($ExportList['result']['data']) < $iteration) {
                break;    
            }
                   
        }
        
        $count=0;
        foreach($arrayUser as $exportInfo) {
            
            $exportInfo['SOURCE'] = 'UNISENDER_EXPORT';
                     
            $ANSWER = CsotbitMailingSubTools::AddSubscribers($exportInfo, array('UNISENDER_EXPORT'=>'Y'));
            if(is_numeric($ANSWER['ID_SUBSCRIBERS'])) {
                $count++;    
            }    
        }
         
        $result = array(
            'COUNT' => $count,
            'STATUS' => 'OK'
        ); 
        return $result;     
           
    }      
    //END    
    
    /**
    * ����� ������� json ���� � ���������� /bitrix/tmp/ ��� ���������� ��������� ���������� ��������.
    * 
    * ����� ����� ��������� � ��������� ���� ����������, ������� ��������� �� ������� ����������
    * 
    * @param string $EVENT_ID ������������� ��������, ��� ������� ������������� ������� ���������
    *  
    * @param string $EVENT_COUNT_RUN ���������� ����� ������� ��������
    *   
    * @param array $SETTING ������ ����������, ������� ��������� ��������� � �����
    * 
    * @param array $MORE_INFO ������ �������������� ����������, ������� ��������� ��������� � �����
    * 
    * @return void|false false ������������ � ������, ���� �� �������� ������������� �������� � �������� $EVENT_COUNT_RUN
    *
    */
    public function ProgressFile($EVENT_ID=false, $EVENT_COUNT_RUN=0,$SETTING=array(), $MORE_INFO=array()) {    
        $file_path =  $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN.".json";
        // �������� �����
        $file_path_dir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/";
        if(!file_exists($file_path_dir)) {
            mkdir($file_path_dir, 0777, true);
        }       
        
        
        
        
        
        
        if(!$EVENT_ID && !$EVENT_COUNT_RUN) {
            return false;    
        }
        $json = json_encode($SETTING);
        
        $f = fopen($file_path, "w");
        fwrite($f, $json); 
        // ������� ��������� ����
        fclose($f);     
        
        
        //������� � ���� ����������
        //START
        if($MORE_INFO['EMAIL_TO_SEND_INFO']){
       
            $file = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_SEND.txt";
            $current = file_get_contents($file);
            $current .= $MORE_INFO['EMAIL_TO_SEND_INFO']."\n";
            // ����� ���������� ������� � ����
            file_put_contents($file, $current);          
        }
        
        if($MORE_INFO['EMAIL_TO_EXCLUDE_HOUR_AGO_INFO']){
       
            $file = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_EXCLUDE_HOUR_AGO.txt";
            $current = file_get_contents($file);
            $current .= $MORE_INFO['EMAIL_TO_EXCLUDE_HOUR_AGO_INFO']."\n";
            // ����� ���������� ������� � ����
            file_put_contents($file, $current);          
        }  
        
        if($MORE_INFO['EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO']){
       
            $file = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_EXCLUDE_UNSUBSCRIBED.txt";
            $current = file_get_contents($file);
            $current .= $MORE_INFO['EMAIL_TO_EXCLUDE_UNSUBSCRIBED_INFO']."\n";
            // ����� ���������� ������� � ����
            file_put_contents($file, $current);          
        }  
          
        if($MORE_INFO['EMAIL_TO_EXCLUDE_UNDELIVERED_INFO']){
       
            $file = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_EMAIL_TO_EXCLUDE_UNDELIVERED.txt";
            $current = file_get_contents($file);
            $current .= $MORE_INFO['EMAIL_TO_EXCLUDE_UNDELIVERED_INFO']."\n";
            // ����� ���������� ������� � ����
            file_put_contents($file, $current);          
        }          
                     
        //END           
                              
    }    
       
    /**
    * ����� ���������� ������ ������ �� ����� �������� ��������� ��������.
    * 
    * ����� ���������� ������ ������� ����������, ������� ������������ ��� ��������� ��������-����
    * ��� ���������� ��������
    * 
    * @param string $EVENT_ID ������������� ��������, ��� ������� ������������� ������� ���������
    *  
    * @param string $EVENT_COUNT_RUN ���������� ����� ������� ��������  
    * 
    * @return array|boolean ������ � ������� ���������� � ���������� �������� ��� false � ������ ���� �������� �� ��� ��������� ��� ���� �� ����������� �� ��������
    *
    */
    public function ProgressFileGetArray($EVENT_ID=0, $EVENT_COUNT_RUN=0) {    
        
        $file_path =  $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN.".json";
            
        if(!$EVENT_ID && !$EVENT_COUNT_RUN) {
            return false;    
        }
        if (!is_readable($file_path)) {
             return false;
        }    
        $f = fopen($file_path, "r+");
        $arr = fgets($f); 
        $info = json_decode($arr);
        // ������� ��������� ����
        fclose($f);   
        $info = (array)$info;
        return $info ;                                        
    }    
   
    /**
    * ����� ������� ����� ��������� ��� ��������.
    * 
    * ����� ���������� ������ ������� ����������, ������� ������������ ��� ��������� ��������-����
    * ��� ���������� ��������
    * 
    * @param string $EVENT_ID ������������� ��������, ��� ������� ������������� ������� ���������
    *  
    * @param string $EVENT_COUNT_RUN ���������� ����� ������� ��������  
    * 
    * @return void
    *
    */
    public function ProgressFileDelete($EVENT_ID=0, $EVENT_COUNT_RUN=0) {    
        $file_path = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN.".json";                    
        unlink($file_path);   
        
        //������ �������������� ����������
        $file_path = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_SEND.txt";    
        unlink($file_path);      
        
        $file_path = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_EXCLUDE_HOUR_AGO.txt";    
        unlink($file_path); 
        
        $file_path = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_".$EVENT_ID."_".$EVENT_COUNT_RUN."_EMAIL_TO_EXCLUDE_UNSUBSCRIBED.txt";    
        unlink($file_path); 
        
        $file_path = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tmp/sotbit_mailing_progress_EMAIL_TO_EXCLUDE_UNDELIVERED.txt";    
        unlink($file_path);           
                 
    }    
    
             

    /**
    * ����� ���������� ����������� ���������� � ������.
    * 
    * @param string $string ������ � ������� ��������� ���������� ������
    *  
    * @param string $variables ������ ���������� � �� �������� ��� ������  
    * 
    * @return string ������ � ����������� �����������.
    *
    */
    public function ReplaceVariables($string=false, $variables=array()) {    
            
        if(isset($string))
        {     
            if($variables!==false && is_array($variables))  {
                foreach($variables as $search => $replace) {
                    $string = str_replace('#'.$search.'#', $replace, $string);                       
                }
             
            }
            return $string;
        }        
        
    }
    
    public function multineedle_stripos($haystack, $needles, $offset=0) {
        
        foreach($needles as $needle) {
            if(stripos($haystack, $needle)!=false){
                return true;
            }
        }
        return false;
        
    }
            
    /**
    * ����� ��������� �� ������ ��������� ����� ����������, ��� ������� ��������� ����������� ��������
    * 
    * ����� ������������� ������������ �������� �� ��������� ������������ �������� � ������ ����������
    * 
    * @param string $TEMPLATE ����� ���������, � ������� �������������� ����� ����������
    *  
    * @return array ������ ����������.
    *
    */
    public function GetNeedVariablesTemplate($TEMPLATE){
        
        $simvolNone = array(
            '"',
            ';',
            '&',
            '<',
            '>',
            '='
        );

        $templateArr = array();
        $chars = preg_split('/[\##]/', $TEMPLATE, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach($chars as $kte => $vte) {
            $countVte = strlen($vte);
            if($countVte < 150 && CSotbitMailingHelp::multineedle_stripos($vte,$simvolNone)==false){
               $templateArr[$vte] = $vte;
            }
        }

        
        return $templateArr; 
        
        
    }
    
    
    public function slaap($seconds=0)
    {
        $seconds = abs($seconds);
        if ($seconds < 1):
           usleep($seconds*1000000);
        else:
           sleep($seconds);
        endif;   
    }     
    
    /**
    * ����� - ����������, ���������� ��� ������� onPageStart ������ main.
    * 
    * ����� ����������� ����� event.php �� ����� �������� ���������� sotbit.mailing.logic, ���� ��� ����������
    * ��� event.php �������� ��� ���������� � ������� ����������� �� �����-���� ������� � �������, ��� �����������.
    * (��������, ��� ����� ������� ������ ����������, ����������� � ����� event.php �������������� �������� ��� ���������� � ������)
    * ������������ ������������ �� ��������, ���� ������������ ������ ��������  
    *
    * @return void
    *
    */   
    public function OnPageStart() {
        // ������� �������� ������� ���������
        // START
        //������� ������� � ���� event.php   
        $arrEventLogicFile = array();          
        $templComponentMailing = CComponentUtil::GetTemplatesList('sotbit:sotbit.mailing.logic',true);
    
        if(is_array($templComponentMailing)) { 
            foreach($templComponentMailing as $valTemp){    
                if($valTemp['NAME'] != '.default') {   
                    if($valTemp['TEMPLATE']) {
                        $fileEventName = '/bitrix/templates/'.$valTemp['TEMPLATE'].'/components/sotbit/sotbit.mailing.logic/'.$valTemp['NAME'].'/event.php';
                        if(file_exists($_SERVER["DOCUMENT_ROOT"].$fileEventName)) {
                            $arrEventLogicFile[$valTemp['NAME']] = $fileEventName;    
                        }                                 
                    } 
                    else {
                        $fileEventName = '/bitrix/components/sotbit/sotbit.mailing.logic/templates/'.$valTemp['NAME'].'/event.php';
                        if(file_exists($_SERVER["DOCUMENT_ROOT"].$fileEventName)) {
                            $arrEventLogicFile[$valTemp['NAME']] = $fileEventName;    
                        } 
                    }                
                }
            }  
        }          
        //��������� ��� ����� � ���������
        //������� �������� ��������
        
        $ar_Temp_id = array();
        $ar_activeTemp = array();
        $db_activeTemp = CSotbitMailingEvent::GetList(array(),array('ACTIVE'=>'Y'),false,array('ID','TEMPLATE','TEMPLATE_PARAMS'));
        while($res_activeTemp = $db_activeTemp->Fetch()) {
            $ar_activeTemp[] = $res_activeTemp['TEMPLATE'];   
            $ar_Temp_id[$res_activeTemp['TEMPLATE']][$res_activeTemp['ID']] = array('ID'=>$res_activeTemp['ID'],'TEMPLATE_PARAMS'=>unserialize($res_activeTemp['TEMPLATE_PARAMS']));
            //$ar_Temp_id[$res_activeTemp['TEMPLATE']][] = $res_activeTemp['ID'];
        }        
        foreach($arrEventLogicFile as $k=>$EventLogicFile) {
            if(in_array($k, $ar_activeTemp)){
                $arResult['MAILING_INFO'] = $ar_Temp_id[$k];
                include($_SERVER["DOCUMENT_ROOT"].$EventLogicFile);
            }
        }
        // END 
                
        // ���������� ������������ �� �������� ����  ���� ���������
        // START  
        if($_GET['USER_AUTH'] && $_GET['MAILING_MESSAGE']) { 
            //������� ������ ������������
            global $USER;
            if(!is_object($USER)){
                $USER = new CUser();
            }
            //�������� ����������� �� ������������  
            if(!$USER->IsAuthorized()) {
                //�������� ������ �� ���� ��� ����������� ������������
                $paramMessage = CSotbitMailingMessage::GetByIDInfoParamMessage($_GET['MAILING_MESSAGE']); 
                if($paramMessage['USER_AUTH']==$_GET['USER_AUTH'] && !empty($paramMessage['USER_ID'])){

					$auth = false;
					$groups = unserialize(Main\Config\Option::get('sotbit.mailing','AUTH_GROUPS','a:1:{i:0;s:1:"6";}'));
                	if(!is_array($groups))
					{
						$groups = [];
					}

					$user_groups = \CUser::GetUserGroup($paramMessage['USER_ID']);

					if(count($groups) > 0 && !in_array(1,$user_groups) && count(array_intersect($groups, $user_groups)) > 0)
					{
						$auth = true;
					}

					if($auth)
					{
						$USER->Authorize($paramMessage['USER_ID']);
					}
                }               
            }
                 
                
        }  
        // END        
    }   
       
    /**
    * ����� - ����������, ���������� ��� ������� OnAfterEpilog ������ main.
    * 
    * ���� ������������ �������� �������, �� �������� ����������, ����� ����� - �������� �� ����� �������� ������������
    * ���� ������������ ��������� �� ��������, �� ������� ��� ������� � ������� ������������
    * ���������� � cookies ������ ������ ������������
    *
    * @return void
    *
    */   
    public function OnAfterEpilog(){
        //���� ������������ �������� �� ��������� �������
        // START  
        if($_GET['MAILING_MESSAGE']) {
            
            $mailing_message = CSotbitMailingMessage::GetByIDInfoStatic($_GET['MAILING_MESSAGE']);  
            
            if($_SERVER['SERVER_NAME']){
                $site_name = $_SERVER['SERVER_NAME'];      
            } 
            elseif($_SERVER['HTTP_HOST']){
                $site_name = $_SERVER['HTTP_HOST'];                
            } 
            if($site_name){
                setcookie('MAILING_CAME_MESSAGE_ID', $_GET['MAILING_MESSAGE'], time()+3600*3, "/", $site_name);         
            }

            
            if($mailing_message) {
                global $DB;
                global $USER;
                if(!is_object($USER)){
                    $USER = new CUser();
                }                
 
                // �������� ������ ��� ���������� ����������
                $arrFields = array();
                if($mailing_message['STATIC_USER_BACK'] == 'N'){
                    $arrFields['STATIC_USER_BACK'] = 'Y';    
                }
                
                // ������� ������� 
                $arrFields['STATIC_USER_BACK_DATE'] = unserialize($mailing_message['STATIC_USER_BACK_DATE']);
                $arrFields['STATIC_USER_ID'] = unserialize($mailing_message['STATIC_USER_ID']);
                $arrFields['STATIC_SALE_UID'] = unserialize($mailing_message['STATIC_SALE_UID']);
                $arrFields['STATIC_GUEST_ID'] = unserialize($mailing_message['STATIC_GUEST_ID']);
                $arrFields['STATIC_PAGE_START'] = unserialize($mailing_message['STATIC_PAGE_START']);     
                
                // ������� � ������� ����� ����������
                //START
                
                //������� ����                                                                                              
                $arrFields['STATIC_USER_BACK_DATE'][] = Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID)));
                
                //������� ������������
                $USER_ID = $USER->GetID();
                if($USER_ID) {
                    $arrFields['STATIC_USER_ID'][] = $USER_ID;                    
                } else {
                    $arrFields['STATIC_USER_ID'][] = 'N';                      
                }
                
                //������� id ������������ �������
               // $SALE_UID = $_COOKIE[COption::GetOptionString("main", "cookie_name", "0").'_SALE_UID'];
                if(CModule::IncludeModule('sale')){
                    $SALE_UID = CSaleBasket::GetBasketUserID();
                    if($SALE_UID) {
                        $arrFields['STATIC_SALE_UID'][] = $SALE_UID;                    
                    } else {
                        $arrFields['STATIC_SALE_UID'][] = 'N';                      
                    }                     
                }                 
                //������� id ����� �� ���-���������
                //$GUEST_ID = $_COOKIE[COption::GetOptionString("main", "cookie_name", "0").'_GUEST_ID'];
                $GUEST_ID = intval($_SESSION["SESS_GUEST_ID"]);
                if($GUEST_ID) {
                    $arrFields['STATIC_GUEST_ID'][] = $GUEST_ID;                    
                } else {
                    $arrFields['STATIC_GUEST_ID'][] = 'N';                      
                }   
                
                //������� ���� ������� ������������
                $user_came_where = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];  
                $arrFields['STATIC_PAGE_START'][] = $user_came_where;           
                //END
                

                //���������� ������ ��� ����
                $arrFields['STATIC_USER_BACK_DATE'] = serialize($arrFields['STATIC_USER_BACK_DATE']);
                $arrFields['STATIC_USER_ID'] = serialize($arrFields['STATIC_USER_ID']);
                $arrFields['STATIC_SALE_UID'] = serialize($arrFields['STATIC_SALE_UID']);
                $arrFields['STATIC_GUEST_ID'] = serialize($arrFields['STATIC_GUEST_ID']);
                $arrFields['STATIC_PAGE_START'] = serialize($arrFields['STATIC_PAGE_START']); 
                
                
                CSotbitMailingMessage::Update($_GET['MAILING_MESSAGE'],$arrFields);
                
                
                //������� �������� ����� ������
                //START
                $user_came_where_redirect = $user_came_where;
                $strReplaceLink = array(
                    'MAILING_MESSAGE='.$_GET['MAILING_MESSAGE'].'&',
                    'MAILING_MESSAGE='.$_GET['MAILING_MESSAGE'],
                    'USER_AUTH='.$_GET['USER_AUTH'].'&',
                    'USER_AUTH='.$_GET['USER_AUTH']                                    
                );                
                foreach($strReplaceLink as $replace){
                    $user_came_where_redirect = str_replace($replace, "",  $user_came_where_redirect);                                
                }   
                LocalRedirect($user_came_where_redirect);            
                //END

                   
            }  
                     
        }
        // END
        
        // ���� ������������ � ������
        // START
        if($_GET['MAILING_FILE_REDURECT']) { 
            LocalRedirect($_GET['MAILING_FILE_REDURECT']);                   
        }      
        // END
        
        
        // ���� ������������ ��������� �� ��������
        // START
        if($_GET['MAILING_UNSUBSCRIBE']) { 
         
            $arrUnscrible = explode('||', $_GET['MAILING_UNSUBSCRIBE']); 
            $ID_MESSEGE = $arrUnscrible[0];
            $ID_EVENT = $arrUnscrible[1];
            if($ID_MESSEGE && $ID_EVENT) {
              
                $MessageInfo = CSotbitMailingMessage::GetByID($ID_MESSEGE);
                if($MessageInfo['ID_EVENT'] == $ID_EVENT && !empty($MessageInfo['EMAIL_TO'])) {
                    global $DB;
                    $EMAIL_TO = $MessageInfo['EMAIL_TO'];
         
                    $resSearch = CSotbitMailingUnsubscribed::GetList(array(), array('ID_EVENT' => $ID_EVENT, 'EMAIL_TO' => $EMAIL_TO));
                    $arrSearch = $resSearch->Fetch();
                    if(empty($arrSearch)) {
                     
                        CSotbitMailingUnsubscribed::Add(array(
                            'DATE_CREATE' => Date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL", SITE_ID))),
                            'ID_MESSEGE' => $ID_MESSEGE,
                            'ID_EVENT' => $ID_EVENT,
                            'EMAIL_TO' => $EMAIL_TO
                        ));                        
                        
                        global $CACHE_MANAGER;       
                        $CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetUnsubscribedByMailing_'.$ID_EVENT);  
                        $CACHE_MANAGER->ClearByTag(self::MODULE_ID.'_GetUnsubscribedAllMailing');                             
                    }                  
                }              
            }                   
        }
        // END
        
        //������ ��� ����������
        //START
        //������� � cookies ������ ������ ������������ 
        $MAILING_USER_CAME = '';
        if($_COOKIE["MAILING_USER_CAME"]){
            $MAILING_USER_CAME = $_COOKIE["MAILING_USER_CAME"];            
        }
        if(empty($MAILING_USER_CAME)) {
            $MAILING_USER_CAME = getenv("HTTP_REFERER");  
            if($MAILING_USER_CAME) {     
                while (preg_match('%([0-9A-F]{2})',$MAILING_USER_CAME)){
                    $val=preg_replace('.*%([0-9A-F]{2}).*','\1',$MAILING_USER_CAME); 
                    $newval=chr(hexdec($val));
                    $MAILING_USER_CAME=str_replace('%'.$val,$newval,$MAILING_USER_CAME); 
                }  
                SetCookie("MAILING_USER_CAME", $MAILING_USER_CAME, time()+7*24*60*60, '/', $_SERVER['SERVER_NAME']);          
            }
            
        } 

            
    }
    
    //������� ����� ������ � ���������
    /**
    * ����� - ����������, ���������� ��� ������� OnOrderAdd ������ sale.
    * 
    * ����� ���������� ����� ������ � ��������� (������� b_sotbit_mailing_message)
    *
    * @return void
    *
    */
    public function OnOrderAdd($ID, $arFields){ 
        
        if($_COOKIE["MAILING_CAME_MESSAGE_ID"] && $ID){ 
            CSotbitMailingMessage::Update($_COOKIE["MAILING_CAME_MESSAGE_ID"],array('STATIC_ORDER_ID'=>$ID));     
        }    
        
            
    }
    
    //���� �����
    function ParseLogMail($file = "/var/log/maillog")
    {
        if(!file_exists($file))
        {
            $error["ERROR"][] = GetMessage(""); //������� ������ � ��������������� �����
            return $error;
        }
        $str = file_get_contents($file);
        if(($str !== false) && strlen($str) > 0)
        {
            $arrLog = explode("\n", $str);
            $noMail = array();
            if(count($arrLog) > 0)
            {
                foreach($arrLog as $lineLog)
                {
                    if(strlen($lineLog) > 0)
                    {    
                        if(preg_match("/said:\s{1}(\d+)/i", $lineLog, $arr))
                        {
                            $arr[1] = trim($arr[1]);
                            if(preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $lineLog, $mail) && !in_array($mail[0], $disabled[$arr[1]]))
                            {
                                
                                $disabled[$arr[1]][] = $mail[0];
                                if(!in_array($mail[0], $email_all))
                                {
                                    $email_all[] = $mail[0];
                                }
                            }
                        }
                       
                    }
                }
                
                if(isset($disabled) && count($disabled)>0)
                {
                    $result["EMAIL_ERROR"] = $disabled;
                    $result["EMAIL_ERROR_ALL"] = $email_all;
                }
            }
            return $result;
        }
        else
        {
             $error["ERROR"][] = GetMessage("ParseLogMail_EMPTY"); //���� ������
             return $error;
        }
    }    
               
}?>