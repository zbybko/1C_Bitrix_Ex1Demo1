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

if (isset($arResult["DETAIL_PICTURE"]["ID"])) {
  $arResImg = CFile::ResizeImageGet(
    $arResult["DETAIL_PICTURE"]["ID"],
    array("width" => 66, "height" => 66),
    BX_RESIZE_IMAGE_PROPORTIONAL
  );
  $src = $arResImg["src"];
} else {
  $src = SITE_TEMPLATE_PATH . "/img/rew/no_photo.jpg";
}

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

$dateArr = getdate(strtotime($arResult["ACTIVE_FROM"]));

$str = $arResult["NAME"] . ', ' . $dateArr["mday"] . ' ' . $month[$dateArr["mon"]] . ' ' . $dateArr["year"] . 'г., ' . $arResult["PROPERTIES"]["POSITION"]["VALUE"] . ', ' . $arResult["PROPERTIES"]["COMPANY"]["VALUE"] . '.';

?>
<div class="review-block">
  <div class="review-text">
    <div class="review-text-cont">
      <? echo $arResult["DETAIL_TEXT"]; ?>
    </div>
    <div class="review-autor">
      <?= $str ?>
    </div>
  </div>
  <div style="clear: both;" class="review-img-wrap"><img src="<?= $src ?>" alt="img"></div>
</div>
<?php if (isset($arResult["DISPLAY_PROPERTIES"]["DOCUMENTS"])): ?>
  <div class="exam-review-doc">
    <p><?= GetMessage("DOCUMENTS") ?></p>
    <? foreach ($arResult["DISPLAY_PROPERTIES"]["DOCUMENTS"]["FILE_VALUE"] as $file): ?>
      <div class="exam-review-item-doc"><img class="rew-doc-ico"
                                             src=<?= SITE_TEMPLATE_PATH . "/img/icons/pdf_ico_40.png" ?>>
        <a href="<?= $file["SRC"] ?>" download="">
          <?= $file["ORIGINAL_NAME"] ?>
        </a>
      </div>
    <? endforeach; ?>
  </div>
<?php endif; ?>
