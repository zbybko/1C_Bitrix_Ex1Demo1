<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$month = array(
  1 => 'января',
  2 => 'февраля',
  3 => 'марта',
  4 => 'апреля',
  5 => 'мая',
  6 => 'июня',
  7 => 'июля',
  8 => 'августа',
  9 => 'сентября',
  10 => 'октября',
  11 => 'ноября',
  12 => 'декабря',
);
?>
<div class="reviews-list">
  <hr>
  <? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if (isset($arItem["PREVIEW_PICTURE"]["ID"])) {
      $arResImg = CFile::ResizeImageGet(
        $arItem["PREVIEW_PICTURE"]["ID"],
        array("width" => 66, "height" => 66),
        BX_RESIZE_IMAGE_PROPORTIONAL
      );
      $src = $arResImg["src"];
    }
    else {
      $src = SITE_TEMPLATE_PATH. "/img/rew/no_photo.jpg";
    }

    $dateArr = getdate(strtotime($arResult["ACTIVE_FROM"]));
    $str = $dateArr["mday"]. ' '. $month[$dateArr["mon"]]. ' '. $dateArr["year"]. 'г., '. $arItem["PROPERTIES"]["POSITION"]["VALUE"].', '. $arItem["PROPERTIES"]["COMPANY"]["VALUE"];
    ?>
    <div class="review-block" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
      <div class="review-text">
        <div class="review-block-title">
          <span class="review-block-name"><a href="<?= $arItem["DETAIL_PAGE_URL"]?>"><? echo $arItem["NAME"] ?></a></span>
          <span class="review-block-description">
          <?= $str ?>
        </span>
        </div>
        <div class="review-text-cont">
          <? echo $arItem["PREVIEW_TEXT"]; ?>
        </div>
      </div>
      <div class="review-img-wrap"><a href="<?= $arItem["DETAIL_PAGE_URL"]?>"><img src="<?= $src ?>" alt="img"></a></div>
    </div>
  <? endforeach; ?>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
  <? endif; ?>

</div>
