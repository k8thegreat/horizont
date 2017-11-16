<?
class CUserTypeIBlockElementBySection extends CUserTypeEnum
{
    function GetUserTypeDescription()
    {
        return array(
            "USER_TYPE_ID" => "iblock_element_by_section",
            "CLASS_NAME" => "CUserTypeIBlockElementBySection",
            "DESCRIPTION" => "Привязка к элементам раздела инфоблока",
            "BASE_TYPE" => "int",
        );
    }

    function PrepareSettings($arUserField)
    {
        $height = intval($arUserField["SETTINGS"]["LIST_HEIGHT"]);
        $disp = $arUserField["SETTINGS"]["DISPLAY"];
        if($disp!="CHECKBOX" && $disp!="LIST")
            $disp = "LIST";
        $iblock_id = intval($arUserField["SETTINGS"]["IBLOCK_ID"]);
        if($iblock_id <= 0)
            $iblock_id = "";
        $element_id = intval($arUserField["SETTINGS"]["DEFAULT_VALUE"]);
        if($element_id <= 0)
            $element_id = "";

        $active_filter = $arUserField["SETTINGS"]["ACTIVE_FILTER"] === "Y"? "Y": "N";

        return array(
            "DISPLAY" => $disp,
            "LIST_HEIGHT" => ($height < 1? 1: $height),
            "IBLOCK_ID" => $iblock_id,
            "DEFAULT_VALUE" => $element_id,
            "ACTIVE_FILTER" => $active_filter,
        );
    }

    function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm)
    {
        $result = '';

        if($bVarsFromForm)
            $section_id = $GLOBALS[$arHtmlControl["NAME"]]["SECTION_ID"];
        elseif(is_array($arUserField))
            $section_id = $arUserField["SETTINGS"]["SECTION_ID"];
        else
            $section_id = "";
        if($bVarsFromForm)
            $iblock_id = $GLOBALS[$arHtmlControl["NAME"]]["IBLOCK_ID"];
        elseif(is_array($arUserField))
            $iblock_id = $arUserField["SETTINGS"]["IBLOCK_ID"];
        else
            $iblock_id = "";
        if(CModule::IncludeModule('iblock'))
        {
            $result .= '
			<tr>
				<td>'.GetMessage("USER_TYPE_IBEL_DISPLAY").':</td>
				<td>
					'.GetSectionList($section_id, $arHtmlControl["NAME"].'[IBLOCK_TYPE_ID]', $arHtmlControl["NAME"].'[IBLOCK_ID]',$arHtmlControl["NAME"].'[SECTION_ID]',array('CHECK_PERMISSIONS' => 'Y','MIN_PERMISSION' => 'W'),
                    "","","",'','','',true,10).'
                </td>
			</tr>
			';
        }
        else
        {
            $result .= '
			<tr>
				<td>'.GetMessage("USER_TYPE_IBEL_DISPLAY").':</td>
				<td>
					<input type="text" size="6" name="'.$arHtmlControl["NAME"].'[SECTION_ID]" value="'.htmlspecialcharsbx($value).'">
				</td>
			</tr>
			';
        }

        if($bVarsFromForm)
            $ACTIVE_FILTER = $GLOBALS[$arHtmlControl["NAME"]]["ACTIVE_FILTER"] === "Y"? "Y": "N";
        elseif(is_array($arUserField))
            $ACTIVE_FILTER = $arUserField["SETTINGS"]["ACTIVE_FILTER"] === "Y"? "Y": "N";
        else
            $ACTIVE_FILTER = "N";

        if($bVarsFromForm)
            $value = $GLOBALS[$arHtmlControl["NAME"]]["DEFAULT_VALUE"];
        elseif(is_array($arUserField))
            $value = $arUserField["SETTINGS"]["DEFAULT_VALUE"];
        else
            $value = "";
        if(($iblock_id > 0) && CModule::IncludeModule('iblock'))
        {
            $result .= '
			<tr>
				<td>'.GetMessage("USER_TYPE_IBEL_DEFAULT_VALUE").':</td>
				<td>
					<select name="'.$arHtmlControl["NAME"].'[DEFAULT_VALUE]" size="5">
						<option value="">'.GetMessage("IBLOCK_VALUE_ANY").'</option>
			';

            $arFilter = Array("IBLOCK_ID"=>$iblock_id, "SECTION_ID" => $section_id);
            if($ACTIVE_FILTER === "Y")
                $arFilter["ACTIVE"] = "Y";

            $rs = CIBlockElement::GetList(
                array("NAME" => "ASC", "ID" => "ASC"),
                $arFilter,
                false,
                false,
                array("ID", "NAME")
            );
            while($ar = $rs->GetNext())
                $result .= '<option value="'.$ar["ID"].'"'.($ar["ID"]==$value? " selected": "").'>'.$ar["NAME"].'</option>';

            $result .= '</select>';
        }
        else
        {
            $result .= '
			<tr>
				<td>'.GetMessage("USER_TYPE_IBEL_DEFAULT_VALUE").':</td>
				<td>
					<input type="text" size="8" name="'.$arHtmlControl["NAME"].'[DEFAULT_VALUE]" value="'.htmlspecialcharsbx($value).'">
				</td>
			</tr>
			';
        }

        if($bVarsFromForm)
            $value = $GLOBALS[$arHtmlControl["NAME"]]["DISPLAY"];
        elseif(is_array($arUserField))
            $value = $arUserField["SETTINGS"]["DISPLAY"];
        else
            $value = "LIST";
        $result .= '
		<tr>
			<td class="adm-detail-valign-top">'.GetMessage("USER_TYPE_ENUM_DISPLAY").':</td>
			<td>
				<label><input type="radio" name="'.$arHtmlControl["NAME"].'[DISPLAY]" value="LIST" '.("LIST"==$value? 'checked="checked"': '').'>'.GetMessage("USER_TYPE_IBEL_LIST").'</label><br>
				<label><input type="radio" name="'.$arHtmlControl["NAME"].'[DISPLAY]" value="CHECKBOX" '.("CHECKBOX"==$value? 'checked="checked"': '').'>'.GetMessage("USER_TYPE_IBEL_CHECKBOX").'</label><br>
			</td>
		</tr>
		';

        if($bVarsFromForm)
            $value = intval($GLOBALS[$arHtmlControl["NAME"]]["LIST_HEIGHT"]);
        elseif(is_array($arUserField))
            $value = intval($arUserField["SETTINGS"]["LIST_HEIGHT"]);
        else
            $value = 5;
        $result .= '
		<tr>
			<td>'.GetMessage("USER_TYPE_IBEL_LIST_HEIGHT").':</td>
			<td>
				<input type="text" name="'.$arHtmlControl["NAME"].'[LIST_HEIGHT]" size="10" value="'.$value.'">
			</td>
		</tr>
		';

        $result .= '
		<tr>
			<td>'.GetMessage("USER_TYPE_IBEL_ACTIVE_FILTER").':</td>
			<td>
				<input type="checkbox" name="'.$arHtmlControl["NAME"].'[ACTIVE_FILTER]" value="Y" '.($ACTIVE_FILTER=="Y"? 'checked="checked"': '').'>
			</td>
		</tr>
		';

        return $result;
    }

    function CheckFields($arUserField, $value)
    {
        $aMsg = array();
        return $aMsg;
    }

    function GetList($arUserField)
    {
        $rsElement = false;
        if(CModule::IncludeModule('iblock'))
        {
            $obElement = new CIBlockElementEnum;
            $rsElement = $obElement->GetTreeList($arUserField["SETTINGS"]["IBLOCK_ID"], $arUserField["SETTINGS"]["ACTIVE_FILTER"]);
        }
        return $rsElement;
    }

    function OnSearchIndex($arUserField)
    {
        $res = '';

        if(is_array($arUserField["VALUE"]))
            $val = $arUserField["VALUE"];
        else
            $val = array($arUserField["VALUE"]);

        $val = array_filter($val, "strlen");
        if(count($val) && CModule::IncludeModule('iblock'))
        {
            $ob = new CIBlockElement;
            $rs = $ob->GetList(array(), array(
                "=ID" => $val
            ), false, false, array("NAME"));

            while($ar = $rs->Fetch())
                $res .= $ar["NAME"]."\r\n";
        }

        return $res;
    }
}


function getSectionPath($id){
    $pathAr = array();
    $nav = CIBlockSection::GetNavChain(false, $id);
    $path = "";
    while($arNav = $nav->GetNext()){
        $path .= " / ".$arNav["NAME"];
    }
    return $path;
}

function GetSectionList($SECTION_ID, $strTypeName, $strIBlockName,$strSectionName, $arFilter = false, $onChangeType = '', $onChangeIBlock = '', $onChangeSection='',$strAddType = '', $strAddIBlock = '',$strAddSection='',$multiple=false,$size="5")
{
    $html = '';

    static $arTypesAll = array();
    static $arTypes = array();
    static $arIBlocks = array();
    static $arSections = array();

    if($multiple)
    {
        $mltp="multiple";
        $ml="[]";
    }
    else
    { $mltp="";$ml="";$size=1;
    }
    if(!is_array($arFilter))
        $arFilter = array();
    if (!array_key_exists('MIN_PERMISSION',$arFilter) || trim($arFilter['MIN_PERMISSION']) == '')
        $arFilter["MIN_PERMISSION"] = "W";
    $filterId = md5(serialize($arFilter));

    if(!isset($arTypes[$filterId]))
    {
        $arTypes[$filterId] = array(0 => "Выберите тип");
        $arIBlocks[$filterId] = array(0 => array(''=>"Выберите инфоблок"));
        $arSections[$filterId] = array(0 => array(''=>"Выберите раздел"));
        $rsIBlocks = CIBlock::GetList(array("IBLOCK_TYPE" => "ASC", "NAME" => "ASC"), $arFilter);
        while($arIBlock = $rsIBlocks->Fetch())
        {
            $tmpIBLOCK_TYPE_ID = $arIBlock["IBLOCK_TYPE_ID"];
            if(!array_key_exists($tmpIBLOCK_TYPE_ID, $arTypesAll))
            {
                $arType = CIBlockType::GetByIDLang($tmpIBLOCK_TYPE_ID, LANG);
                $arTypesAll[$arType["~ID"]] = $arType["~NAME"]." [".$arType["~ID"]."]";
            }
            if(!array_key_exists($tmpIBLOCK_TYPE_ID, $arTypes[$filterId]))
            {
                $arTypes[$filterId][$tmpIBLOCK_TYPE_ID] = $arTypesAll[$tmpIBLOCK_TYPE_ID];
            }
            $arIBlocks[$filterId][$tmpIBLOCK_TYPE_ID][$arIBlock["ID"]] = $arTypesAll[$tmpIBLOCK_TYPE_ID].":".$arIBlock["NAME"]." [".$arIBlock["ID"]."]";
            $arFilter = Array('IBLOCK_ID'=>$arIBlock["ID"], 'GLOBAL_ACTIVE'=>'Y', 'INCLUDE_SUBSECTIONS'=>'Y');
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
            while($ar_result = $db_list->GetNext())
            {
                $arSections[$filterId][$arIBlock["ID"]][$ar_result['ID']]=$arIBlocks[$filterId][$tmpIBLOCK_TYPE_ID][$arIBlock["ID"]].getSectionPath($ar_result['ID']);
            }
        }
    }

    $html .= '
      <script>
      function OnType_'.$filterId.'_Changed(typeSelect, iblockSelectID)
      {
         var arIblocs = '.CUtil::PhpToJSObject($arIBlocks[$filterId]).';
         var iblockSelect = BX(iblockSelectID);
         if(iblockSelect)
         {
            var sel=getSelectedIndexes(typeSelect);
            for(var i=iblockSelect.length-1; i >= 0; i--)
               iblockSelect.remove(i);
            for(var k=sel.length-1;k>=0;k--)
            {
               for(var j in arIblocs[sel[k]])
               {
                  var newOption = new Option(arIblocs[sel[k]][j], j, false, false);
                  iblockSelect.options.add(newOption);
               }
            }
         }
      }
      function OnIBlock_'.$filterId.'_Changed(iblockSelect, sectionSelectID)
      {
         var arSections = '.CUtil::PhpToJSObject($arSections[$filterId]).';
         var SectionSelect = BX(sectionSelectID);
         if(SectionSelect)
         {
            var sel=getSelectedIndexes(iblockSelect);
            for(var i=SectionSelect.length-1; i >= 0; i--)
               SectionSelect.remove(i);
            for(var k=sel.length-1;k>=0;k--)
            {
               for(var j in arSections[sel[k]])
               {
                  var newOption = new Option(arSections[sel[k]][j], j, false, false);
                  SectionSelect.options.add(newOption);
               }
            }
         }
      }
      function getSelectedIndexes (oListbox)
      {
         var arrIndexes = new Array;
         for (var i=0; i < oListbox.options.length; i++)
         {
            if (oListbox.options[i].selected) arrIndexes.push(oListbox.options[i].value);
         }
         return arrIndexes;
      };
      </script>
      ';
    $IBLOCK_TYPE = false;
    $IBLOCK = false;
    if(is_array($SECTION_ID) && count($SECTION_ID)>0)
    {
        foreach($SECTION_ID as $section)
        {
            foreach($arSections[$filterId] as $iblock_id => $sections)
            {
                if(array_key_exists($section, $sections))
                {
                    $IBLOCK_ID[] = $iblock_id;
                }
            }
        }
        $IBLOCK_ID=array_unique($IBLOCK_ID);
        foreach($IBLOCK_ID as $iblock)
        {
            foreach($arIBlocks[$filterId] as $iblock_type_id => $iblocks)
            {
                if(array_key_exists($iblock, $iblocks))
                {
                    $IBLOCK_TYPE[] = $iblock_type_id;
                }
            }
        }
        $IBLOCK_TYPE=array_unique($IBLOCK_TYPE);
    }
    else
    {
        if($SECTION_ID > 0)
        {
            foreach($arSections[$filterId] as $iblock_id => $sections)
            {
                if(array_key_exists($SECTION_ID, $sections))
                {
                    $IBLOCK_ID = $iblock_id;
                    break;
                }
            }
            foreach($arIBlocks[$filterId] as $iblock_type_id => $iblocks)
            {
                if(array_key_exists($IBLOCK_ID, $iblocks))
                {
                    $IBLOCK_TYPE = $iblock_type_id;
                    break;
                }
            }

        }
    }
    $htmlTypeName = htmlspecialcharsbx($strTypeName);
    $htmlIBlockName = htmlspecialcharsbx($strIBlockName);
    $htmlSectionName = htmlspecialcharsbx($strSectionName);
    $onChangeType = 'OnType_'.$filterId.'_Changed(this, \''.CUtil::JSEscape($strIBlockName).'\');'.$onChangeType.';';
    $onChangeIBlock = 'OnIBlock_'.$filterId.'_Changed(this, \''.CUtil::JSEscape($strSectionName).'\');'.$onChangeIBlock.';';

    $html .= '<select '.$mltp.' size="'.$size.'" name="'.$htmlTypeName.$ml.'" id="'.$htmlTypeName.'" onchange="'.htmlspecialcharsbx($onChangeType).'" '.$strAddType.'>'."\n";
    foreach($arTypes[$filterId] as $key => $value)
    {
        if($IBLOCK_TYPE === false)
            $IBLOCK_TYPE = $key;
        elseif(is_array($IBLOCK_TYPE))
        {
            $html .= '<option value="'.htmlspecialcharsbx($key).'"'.(in_array($key,$IBLOCK_TYPE) ? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
        }
        else
            $html .= '<option value="'.htmlspecialcharsbx($key).'"'.($IBLOCK_TYPE===$key? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
    }
    $html .= "</select>\n";
    $html .= "&nbsp;\n";
    $html .= '<select '.$mltp.' size="'.$size.'"  name="'.$htmlIBlockName.$ml.'" id="'.$htmlIBlockName.'" onchange="'.htmlspecialcharsbx($onChangeIBlock).'" '.$strAddIBlock.'>'."\n";
    if(is_array($IBLOCK_TYPE))
    {
        foreach($IBLOCK_TYPE as $iblock_type)
        {
            foreach($arIBlocks[$filterId][$iblock_type] as $key => $value)
            {
                $html .= '<option value="'.htmlspecialcharsbx($key).'"'.(in_array($key,$IBLOCK_ID) ? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
            }
        }
    }
    else
        foreach($arIBlocks[$filterId][$IBLOCK_TYPE] as $key => $value)
        {
            $html .= '<option value="'.htmlspecialcharsbx($key).'"'.($IBLOCK_ID==$key? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
        }
    $html .= "</select>\n";
    $html .="&nbsp;\n";
    $html .= '<select '.$mltp.' size="'.$size.'" name="'.$htmlSectionName.$ml.'" id="'.$htmlSectionName.'"'.($onChangeSection != ''? ' onchange="'.htmlspecialcharsbx($onChangeSection).'"': '').' '.$strAddSection.'>'."\n";
    if(is_array($IBLOCK_ID))
    {
        foreach($IBLOCK_ID as $iblock)
        {
            foreach($arSections[$filterId][$iblock] as $key => $value)
            {
                $html .= '<option value="'.htmlspecialcharsbx($key).'"'.(in_array($key,$SECTION_ID) ? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
            }
        }
    }
    else
        foreach($arSections[$filterId][$IBLOCK_ID] as $key => $value)
        {
            $html .= '<option value="'.htmlspecialcharsbx($key).'"'.($SECTION_ID==$key? ' selected': '').'>'.htmlspecialcharsEx($value).'</option>'."\n";
        }
    $html .= "</select>\n";
    return $html;
}
?>