<?
/**
 * Company developer: ALTASIB
 * Developer: adumnov
 * Site: http://www.altasib.ru
 * E-mail: dev@altasib.ru
 * @copyright (c) 2006-2015 ALTASIB
 */
?>
<style>
.alx-main{
	width:510px;
	padding:10px;
	border:none;
}
.alx-gbase-main-box{
	display:block;
	padding-bottom:10px;
	margin-bottom:5px;
	position:relative;
	width:100%;
}
.alx-gbase-main-box span{
	display:inline-block;
}
.alx-gbase-main-box > div{
	margin:10px 0 5px 0;
	text-align:right;
}
.alx-gbase-progress-bar{
	width:100%;
	height:14px
}
.alx-gbase-progress-bar span{
	position:absolute;
}
.alx-gbase-progress-bar > span{
	border:1px solid silver;
	width:92%;
	left:2px;
	height:14px;
	text-align:left;
}
.alx-gbase-progress-bar > span + span{
	padding-left:2px;
	border:none;
	width:7%;
	height:14px;
	left:auto;
	right:0;
	text-align:right
}
#progress{
	height:14px;
	background:#637f9c;
}
</style>

<script language="JavaScript">
var timer, obData, updateMode;
altasib_geobase_obHandler = function (data) {
	var progress, value, title, send;
	updateMode = <?=($update_mode ? 'true' : 'false')?>;
	obData = JSON.parse(data);
	progress = document.getElementById('progress');
	value = document.getElementById('value');
	title = document.getElementById('title');
	if (obData.STATUS == 3){
		send = {
			"action": obData.NEXT_STEP,
			"timeout": 4
		};
		progress.style.width = obData.PROGRESS + '%';
		value.innerHTML = obData.PROGRESS + '%';
		BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', send, altasib_geobase_obHandler);
	}
	else if (obData.STATUS == 2) {
		send = {
			"action": obData.NEXT_STEP,
			"by_step": "Y",
			"filename": obData.FILENAME ? obData.FILENAME : '',
			"seek": obData.SEEK,
			"timeout": 4
		};
		progress.style.width = obData.PROGRESS + '%';
		value.innerHTML = obData.PROGRESS + '%';
		if (obData.PROGRESS == 100) {
			timer = setInterval(function () {
				title.innerHTML = "<?=GetMessage("ALTASIB_TITLE_UNPACK_FILE")?>";
				progress.style.width = 0 + '%';
				value.innerHTML = 0 + '%';
				BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', send, altasib_geobase_obHandler);
				clearInterval(timer);
			}, 500);
		} else {
			BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', send, altasib_geobase_obHandler);
		}
	}
	else if (obData.STATUS == 1) {
		send = {
			"action": obData.NEXT_STEP,
			"filename": obData.FILENAME ? obData.FILENAME : '',
			"seek": obData.SEEK ? obData.SEEK : 0,
			"drop_t": obData.DROP_T,
			"timeout": 4
		};
		progress.style.width = obData.PROGRESS + '%';
		value.innerHTML = obData.PROGRESS + '%';
		if (obData.PROGRESS == 100) {
			timer = setInterval(function () {
				title.innerHTML = "<?=GetMessage("ALTASIB_TITLE_DB_UPDATE")?>";
				progress.style.width = 0 + '%';
				value.innerHTML = 0 + '%';
				BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', send, altasib_geobase_obHandler);
				clearInterval(timer);
			}, 500);
		} else {
			BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', send, altasib_geobase_obHandler);
		}
	}
	else if (obData.STATUS == 0) {
		document.getElementById("form_setup").submit();
	}
};
function altasib_geobase_updateDB() {
	BX.ajax.post('/bitrix/admin/altasib_geobase_update.php', {'action':'LOAD', "timeout":3}, altasib_geobase_obHandler);
}

BX.ready(function(){
	altasib_geobase_updateDB();
});
</script>

<div class="alx-main" style="text-align: center">
	<div class="alx-gbase-main-box" id="alxLoaderUI">
		<h3 id="title"><?=GetMessage("ALTASIB_TITLE_LOAD_FILE")?></h3>
		<span class="alx-gbase-progress-bar">
			<span>
				<span id="progress"></span>
			</span>
			<span id="value">0%</span>
		</span>
	</div>

	<form action="<?=$APPLICATION->GetCurPage()?>" id="form_setup">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>"/>
		<input type="hidden" name="id" value="altasib.geobase"/>
		<input type="hidden" name="install" value="N"/>
		<input type="hidden" name="step" value="3"/>
	<?if (isset($_REQUEST['LOAD_DATA_MM'])){?>
		<input type="hidden" name="LOAD_DATA_MM" value="<?=$_REQUEST['LOAD_DATA_MM']?>" />
	<?}
	if ($_REQUEST['GET_UPDATE'] == 'Y' || $_REQUEST['GET_UPDATE'] == "N"):?>
		<input type="hidden" name="GET_UPDATE" value="<?=$_REQUEST['GET_UPDATE']?>" />
	<?endif;?>
	<?if ($_REQUEST['MM_GET_UPDATE'] == 'Y' || $_REQUEST['MM_GET_UPDATE'] == "N"):?>
		<input type="hidden" name="MM_GET_UPDATE" value="<?=$_REQUEST['MM_GET_UPDATE']?>" />
	<?endif;?>
	</form>
</div>