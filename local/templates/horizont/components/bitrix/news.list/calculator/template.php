<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $_REQUEST["calc_submit"]) {
    $APPLICATION->RestartBuffer();

    if(IntVal($_REQUEST["PRICE"]) && IntVal($_REQUEST["PERIOD"]) && IntVal($_REQUEST["RATE"])){
        if(IntVal($_REQUEST["SUM"])){
            $S = IntVal($_REQUEST["PRICE"]) - IntVal($_REQUEST["SUM"]);
        }else{
            $S = IntVal($_REQUEST["PRICE"]);
        }
        $rate = floatval($_REQUEST["RATE"])/100/12;
        $m = IntVal($_REQUEST["PERIOD"])*12;
        $sum = $S*($rate/(1-pow(1+$rate, -$m)));
    }

    if ($sum){
        $success_str = "<p>Ежемесячный платеж: <b>".number_format($sum,0,".", " ")." руб/мес.</b></p>";
    }
    ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
    die();
}else{
    ?>
	<form id="calc-form" action="" method="post" enctype="multipart/form-data" >
		<div class="values">
			<label>
				<span>Процентная ставка, %</span>
				<input type="text" class="required" name="RATE" value="<?=(RATE_MIN_LOCAL ? RATE_MIN_LOCAL : RATE_MIN_GLOBAL)?>"/>
			</label>
			<label>
				<span>Стоимость квартиры, руб.</span>
				<input type="text" class="required" name="PRICE" value="<?=$arResult["PROPERTIES"]["price_discount"]["VALUE"]?>"/>
			</label>
			<label>
				<span>Первый взнос, руб.</span>
				<input type="text"  name="SUM" value=""/>
			</label>
			<label>
				<span>Срок ипотеки, лет</span>
				<input type="text"  name="PERIOD" class="required" value=""/>
			</label>
		</div>
		<div class="price-month">
			<p></p>
		</div>
		<div class="btn-center">
			<button type="submit" class="btn btn-full" value="Y" name="calc_submit">Рассчитать</button>
		</div>
	</form>
<?}?>

