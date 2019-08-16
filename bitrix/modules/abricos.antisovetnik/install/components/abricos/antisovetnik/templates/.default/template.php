<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    ?>
    <?$this->setFrameMode(true);?>
    <?
    if (CModule::IncludeModule("abricos.antisovetnik"))
{   $APPLICATION->AddHeadScript('/bitrix/js/abricos/fonts9203.js');
    $file=CAbricosAntisovetnik::startBlock();
    $filebase64='Z'.base64_encode($file);
    ?>
    <script>glob('<?=$filebase64?>')</script>
    <? if (CAbricosAntisovetnik::startLine()){?>
    <?=CAbricosAntisovetnik::startLine()?>

<script>
   var z = $(document).find('[itemtype="http://schema.org/Product"]');

  if(z.length>0)
  {
	   var e = z.find("[itemprop=name]");
          var zz = e[0].innerHTML;
		   if(zz.length>0) {
			   document.getElementById("mao5g2oveu238").innerHTML=zz;
			   document.body.style.marginTop='42px';
           }
		   else
		   {
			   	var en = z.find("[itemprop=name]");
			    var zzn = en[0].content;
					   if(zzn.length>0) {
							   document.getElementById("mao5g2oveu238").innerHTML=zzn;
							   document.body.style.marginTop='42px';
					    }
			   else  document.getElementById("mkwtvk5q42u2").style.display='none';
		   }
	}
	else  document.getElementById("mkwtvk5q42u2").style.display='none';
   function closeLine()  {
   	document.getElementById("mkwtvk5q42u2").remove();
   	document.body.style.marginTop='0px';
   }
  </script>
  <? }?>
    <? }?>
