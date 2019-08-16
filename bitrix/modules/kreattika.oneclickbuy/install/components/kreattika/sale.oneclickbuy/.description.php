<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# Component: sale.oneclickbuy                                                                              #
# File: .description.php                                                                                   #
# Version: 1.0.1                                                                                           #
# (c) 2011-2018 Kreattika, Sedov S.Y. (ООО "КРЕАТТИКА", Седов С.Ю.)                                        #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("KOCB_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("KOCB_COMPONENT_DESCR"),
	"ICON" => "/images/feedback.gif",
	"PATH" => array(
		"ID" => "kreattika",
		"NAME" => GetMessage("KOCB_COMPONENT_FOLDER_NAME"),
		"CHILD" => array(
			"ID" => "sale",
			"NAME" => GetMessage("KOCB_COMPONENT_SUBFOLDER_NAME"),
			"SORT" => 10,
		)
	),
);
?>