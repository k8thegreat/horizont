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
    ?>
            <form name="iblock_add" id="callback-form" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
            <label class="input-default">
                <input type="text" value="+7 " class="phone required" placeholder="+7 (___) ___-__-__" name="PROPERTY[NAME][0]"/>
            </label>
                <div class="agreement-link"><?=GetMessage("USER_AGREEMENT_TEXT")?></div>
            <div class="btn-center">
                <button type="submit" class="btn btn-full" name="iblock_submit" value="Y"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>
            </div>
<?=bitrix_sessid_post()?>
<div class="msg">
                    <?if (strlen($arResult["MESSAGE"]) > 0):?>
                        <?=ShowNote($arResult["MESSAGE"])?>
                    <?endif?>
                </div>
        </form>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#callback-form .required").change(function(){
                if($(this).val()) $(this).removeClass("error");
                else $(this).addClass("error");
            });
            var callback_form_options = {
                type: "post",
                dataType: "json",
                success: function(data){
                    $("#callback-form button").attr("disabled", "").removeClass("disabled");
                    if(data.errorstr){

                        $("#callback-form .errors").html(data.errorstr);
                    }else{
                        if(data.success){
                            $("#callback-form .errors").html("");
                            $("#callback-form")[0].reset();
                            $("#callback-form .msg").text(data.success);

                        }
                    }
                },
                beforeSubmit: function(){
                    var error = false;
                    $("#callback-form .errors").text();
                    $("#callback-form .required").each(function(){
                        if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                        switch (type) {
                            case 'text':
                            case 'textarea':
                                if(!$(this).val() || ($(this).hasClass("phone") && !$(this).hasClass("is-valid"))){
                                    error = true;
                                    $(this).addClass("error");
                                }
                                break;
                        }
                    });
                    if(error == true) {
                        return false;
                    }
                    $("#callback-form .errors").html("");
                    $("#callback-form button").attr("disabled", "disabled").addClass("disabled");
                }
            }
            $('#callback-form').ajaxForm(callback_form_options);
        });
    </script>
<?}?>