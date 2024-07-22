<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult["COMPANY"] = $arResult["PROPERTIES"]["COMPANY"]["VALUE"];
$this->getComponent()->setResultCacheKeys(array("NAME", "PREVIEW_TEXT", "COMPANY"));
