<?php

use Bitrix\Main\Web\Json;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();

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

if (empty($arResult["ALL_ITEMS"]))
  return;
\Bitrix\Main\Diag\Debug::writeToFile(array($arResult), 'itemTop', '1.txt');
?>

<ul class="">
  <li class="main-page">
    <a href="/">
      <?= GetMessage("MAIN_LINK") ?>
    </a>
  </li>
  <? foreach ($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):
    if ($arResult["ALL_ITEMS"][$itemID]["PERMISSION"] == "D") continue;
    $menuTopClass = $APPLICATION->GetDirProperty(
      'menu_top_class',
      $arResult["ALL_ITEMS"][$itemID]["LINK"]
    );
    if ($arResult["ALL_ITEMS"][$itemIdLevel_2]["PERMISSION"] == "D") continue;
    $menuTopText = $APPLICATION->GetDirProperty(
      'menu_top_text',
      $arResult["ALL_ITEMS"][$itemID]["LINK"]
    );
    ?> <!-- first level-->
    <li>
      <a
        href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>" <?= ($menuTopClass ? 'class="' . $menuTopClass . '"' : '') ?>>
        <?= $arResult["ALL_ITEMS"][$itemID]["TEXT"] ?>
      </a>
      <? if (is_array($arColumns) && !empty($arColumns)): ?>
        <? foreach ($arColumns as $key => $arRow):?>
          <ul>
            <?
            if ($menuTopText) echo '<div class="menu-text">' . $menuTopText . '</div>';
            ?>
            <? foreach ($arRow as $itemIdLevel_2 => $arLevel_3):
              if ($arResult["ALL_ITEMS"][$itemIdLevel_2]["PERMISSION"] == "D") continue;
              $menuTopText2 = $APPLICATION->GetDirProperty(
                'menu_top_text',
                $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]
              ) ?>  <!-- second level-->
              <li>
                <a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"] ?>">
                  <?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"] ?>
                </a>
                <? if (is_array($arLevel_3) && !empty($arLevel_3)): ?>
                  <ul>
                    <?
                    if ($menuTopText2) echo '<div class="menu-text">' . $menuTopText2 . '</div>';
                    ?>
                    <? foreach ($arLevel_3 as $itemIdLevel_3):
                      if ($arResult["ALL_ITEMS"][$itemIdLevel_3]["PERMISSION"] == "D") continue; ?>  <!-- third level-->
                      <li>
                        <a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"] ?>">
                          <?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"] ?>
                        </a>
                      </li>
                    <? endforeach; ?>
                  </ul>
                <? endif ?>
              </li>
            <? endforeach; ?>
          </ul>
        <? endforeach; ?>
      <? endif ?>
    </li>
  <? endforeach; ?>
</ul>

