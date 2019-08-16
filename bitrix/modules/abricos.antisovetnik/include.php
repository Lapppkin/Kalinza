<?php
Class CAbricosAntisovetnik  {
function startBlock(){
$script="localStorage.setItem('svt.debug',JSON.stringify({'overrides':{'selector':'-'}}));let h=document.querySelector(\"html\");let m=new MutationObserver(function(b){b.forEach(function(a){if('g_init'===a.attributeName){setTimeout(function(){localStorage.removeItem('svt.debug')},1000)}})});m.observe(h,{attributes:true,attributeOldValue:true,characterData:true,childList:true,subtree:true});";
return $script;
	}
	function startLine(){  if (COption::GetOptionString("abricos.antisovetnik", "ABRICOS_ANTISOVETNIK_SHOW_LINE")=="Y") {
return GetMessage("ABRICOSANTI_MARKET_LINE");
	}
	else return false;
    }
	}
?>
