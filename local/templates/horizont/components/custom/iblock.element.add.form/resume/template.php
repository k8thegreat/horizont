<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $_REQUEST["iblock_submit"]) {
    $APPLICATION->RestartBuffer();
    if (strlen($arResult["MESSAGE"]) > 0){
        $success_str = $arResult["MESSAGE"];
    }
    if (count($arResult["ERRORS"]) > 0 || $arResult["ERROR_MESSAGE"]){
        if($arResult["ERRORS"]){
            foreach ($arResult["ERRORS"] as $key => $error){
                if (intval($key) == 0 && $key !== 0)
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "".GetMessage("REGISTER_FIELD_".$key)."", $error);
                //$arResult["ERRORS"][$key] = str_replace('"', '2', $arResult["ERRORS"][$key]);
            }
            $error_str=implode("<br />", $arResult["ERRORS"]);
        }elseif($arResult["ERROR_MESSAGE"]){
            $error_str=$arResult["ERROR_MESSAGE"];
        }
    }
    ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
    die();
}else{
    $form_id = rand(1000,9999);
    ?>
<form name="iblock_add" id="feedback-form<?=$form_id?>" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<div  class="result-form-callback">
		<label class="input-file">
			<input type="hidden" name="PROPERTY[44][0]" value="" />
			<input type="file" name="PROPERTY_FILE_44_0" />
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512"  xml:space="preserve" width="20px">
				<path fill="#fff" d="M359.784,103.784v262.919c0,57.226-46.557,103.784-103.784,103.784s-103.784-46.557-103.784-103.784V103.784    c0-34.336,27.934-62.27,62.27-62.27c34.336,0,62.27,27.934,62.27,62.27v262.919c0,11.445-9.312,20.757-20.757,20.757    s-20.757-9.311-20.757-20.757V103.784H193.73v262.919c0,34.336,27.934,62.27,62.27,62.27s62.27-27.934,62.27-62.27V103.784    C318.27,46.557,271.713,0,214.487,0S110.703,46.557,110.703,103.784v262.919C110.703,446.82,175.883,512,256,512    s145.297-65.18,145.297-145.297V103.784H359.784z"/>
			</svg>
			<span>Прикрепить файл</span>
		</label>
		<label>
			<input type="text" type="tel" class="phone required" value="+7 " placeholder="<?=$arParams["CUSTOM_TITLE_NAME"]?>" name="PROPERTY[NAME][0]"/>
		</label>
		<button type="submit" class="btn btn-border-white btn-callback" name="iblock_submit" value="Y"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>
		<?=bitrix_sessid_post()?>
	</div>
	<div class="errors">
	<?if (count($arResult["ERRORS"])):?>
		<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
	<?endif?>
	</div>
	<div class="msg">
	<?if (strlen($arResult["MESSAGE"]) > 0):?>
		<?=ShowNote($arResult["MESSAGE"])?>
	<?endif?>
	</div>
</form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#feedback-form<?=$form_id?> .required").change(function(){
                if($(this).val()) $(this).removeClass("error");
                else $(this).addClass("error");
            });
            var form_options<?=$form_id?> = {
                type: "post",
                dataType: "json",
                success: function(data){
                    $("#feedback-form<?=$form_id?> button").attr("disabled", "").removeClass("disabled");
                    if(data.errorstr){

                        $("#feedback-form<?=$form_id?> .errors").html(data.errorstr);
                    }else{
                        if(data.success){
                            $("#feedback-form<?=$form_id?> .errors").html("");
                            $("#feedback-form<?=$form_id?>")[0].reset();
                            $("#feedback-form<?=$form_id?> .msg").text(data.success);

                        }
                    }

                },
                beforeSubmit: function(){
                    var error = false;
                    $("#feedback-form<?=$form_id?> .errors").text();
                    $("#feedback-form<?=$form_id?> .required").each(function(){
                        if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                        switch (type) {
                            case 'text':
                            case 'textarea':
                                if(!$(this).val() || ($(this).hasClass("phone") && $(this).val()=="+7 ")){
                                    error = true;
                                    $(this).addClass("error");
                                }
                                break;
                        }
                    });

                    if(error == true) {
                        return false;
                    }
                    $("#feedback-form<?=$form_id?> .errors").html("");
                    $("#feedback-form<?=$form_id?> button").attr("disabled", "disabled").addClass("disabled");
                }
            }

            $('#feedback-form<?=$form_id?>').ajaxForm(form_options<?=$form_id?>);
        });

    </script>
<?}?>