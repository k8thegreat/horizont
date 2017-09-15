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
                    <label>
                        <input type="text" class="required" placeholder="<?=$arParams["CUSTOM_TITLE_NAME"]?>" name="PROPERTY[NAME][0]"/>
                    </label>
                    <label>
                        <input type="text" class="phone required"  placeholder="Ваш телефон" value="+7 "  name="PROPERTY[45][0]">
                    </label>
                    <label class="textarea">
                        <textarea rows="7" placeholder="<?=$arParams["CUSTOM_PREVIEW_TEXT_NAME"]?>" name="PROPERTY[PREVIEW_TEXT][0]"></textarea>
                    </label>
                    <div class="btn-center">
                        <button type="submit" class="btn btn-border-white btn-callback" name="iblock_submit" value="Y"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>
                    </div>
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