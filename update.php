<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/*if (CModule::IncludeModule("iblock")) {
    $bs = new CIBlockSection;
    $arFilter = array('IBLOCK_ID' => CATALOG_IBLOCK_ID);
    $rsSect = CIBlockSection::GetList(array(),$arFilter, false, array("UF_*"));
    while ($arSect = $rsSect->GetNext())
    {

       echo $res = $bs->Update($arSect["ID"], array(
           "NAME" => $arSect["NAME"],
           "UF_LOCALITY_NAME" => $arSect["UF_LOCALITY_NAME"],
           "UF_SUB_LOCALITY_NAME" => $arSect["UF_SUB_LOCALITY_NAME"],
           "UF_DISTRICT" => $arSect["UF_DISTRICT"],
           "UF_REGION" => $arSect["UF_REGION"],
           "UF_PAYMENT" => $arSect["UF_PAYMENT"],
           "UF_METRO_ID" => $arSect["UF_METRO_ID"],
           "UF_DEVELOPER" => $arSect["UF_DEVELOPER"],
           "UF_BANKS" => $arSect["UF_BANKS"],
       ));
    }
}


/*if (CModule::IncludeModule("iblock")) {
    $res = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y"), false, array());
    while($arSection = $res->GetNext()) {
        $sectionID = $arSection["ID"];
        $arSelect = Array("ID", "NAME", "PROPERTY_locality_name");
        $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $sectionID);
        $res2 = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        if ($ob = $res2->GetNextElement()) {
            $arFields = $ob->GetFields();
            $val = $arFields["PROPERTY_LOCALITY_NAME_VALUE"];
            $bs = new CIBlockSection;
            $bs->Update($sectionID, array("UF_LOCALITY_NAME" => $val));
        }


    }
}
/*
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
$arFilter = Array(
    "ACTIVE"=>"Y",
    "!PREVIEW_PICTURE" => false
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $url = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
    if($url) //print_r($arFields);
    $iblockArr[] = $url;

}
$arFilter = array( '!PICTURE' => false);
$rsSections = CIBlockSection::GetList(array(), $arFilter);
while ($arSction = $rsSections->Fetch())
{
    $url = CFile::GetPath($arSction["PICTURE"]);
    if($url) //print_r($arFields);
        $iblockArr2[] = $url;
}
$arSelect = Array("ID", "NAME", "PROPERTY_MORE_PHOTO");
$arFilter = Array(
        "IBLOCK_ID" => 6, 
    "ACTIVE"=>"Y",
    "!PROPERTY_MORE_PHOTO" => false
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();

    $url = CFile::GetPath($arFields["PROPERTY_MORE_PHOTO_VALUE"]);
    if($url)
        $iblockArr3[] = $url;

}

$iblockFiles = array_merge($iblockArr, $iblockArr2, $iblockArr3);
//print_r($iblockFiles);
$dir = $_SERVER["DOCUMENT_ROOT"]."/upload/iblock";
$dir = "upload/iblock";
function find_all_files($dir)
{
    $root = scandir($dir);
    foreach($root as $value)
    {
        if($value === '.' || $value === '..') {continue;}
        if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
        foreach(find_all_files("$dir/$value") as $value)
        {
            $result[]="/".$value;
        }
    }
    return $result;
}
$serverFiles = find_all_files($dir);
//print_r($serverFiles);
foreach ($serverFiles as $file){
    if(!in_array($file, $iblockFiles))
        if(unlink($_SERVER["DOCUMENT_ROOT"].$file)) $deleted++;
}
echo $deleted;
die();

$res = CFile::GetList(array(), array("MODULE_ID"=>"iblock"));
while($res_arr = $res->GetNext()){
    $i++;
    $arFilesCache[$row['FILE_NAME']] = $row['SUBDIR'];
}
echo $i;

die();
global $DB;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
$deleteFiles = 'yes'; //Удалять ли найденые файлы yes/no
$saveBackup = 'no'; //Создаст бэкап файла yes/no
//Папка для бэкапа
$patchBackup = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock_Backup/";
//Целевая папка для поиска файлов
$rootDirPath = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock";

$time_start = microtime(true);

//Создание папки для бэкапа
if (!file_exists($patchBackup)) {
    CheckDirPath($patchBackup);
}
// Получаем записи из таблицы b_file
$arFilesCache = array();
$res = CFile::GetList(array(), array("MODULE_ID"=>"iblock"));
while($res_arr = $res->GetNext()){
    $arFilesCache[$row['FILE_NAME']] = $row['SUBDIR'];
}
$hRootDir = opendir($rootDirPath);
$count = 0;
$contDir = 0;
$countFile = 0;
$i = 1;
$removeFile=0;
while (false !== ($subDirName = readdir($hRootDir))) {
    if ($subDirName == '.' || $subDirName == '..') {
        continue;
    }
    //Счётчик пройденых файлов
    $filesCount = 0;
    $subDirPath = "$rootDirPath/$subDirName"; //Путь до подкатегорий с файлами
    $hSubDir = opendir($subDirPath);
    while (false !== ($fileName = readdir($hSubDir))) {
        if ($fileName == '.' || $fileName == '..') {
            continue;
        }
        $countFile++;
        if (array_key_exists($fileName, $arFilesCache)) { //Файл с диска есть в списке файлов базы - пропуск
            $filesCount++;
            continue;
        }
        $fullPath = "$subDirPath/$fileName"; // полный путь до файла
        $backTrue = false; //для создание бэкапа
        if ($deleteFiles === 'yes') {
            if (!file_exists($patchBackup . $subDirName)) {
                if (CheckDirPath($patchBackup . $subDirName . '/')) { //создал поддиректорию
                    $backTrue = true;
                }
            } else {
                $backTrue = true;
            }
            if ($backTrue) {
                if ($saveBackup === 'yes') {
                    CopyDirFiles($fullPath, $patchBackup . $subDirName . '/' . $fileName); //копия в бэкап
                }
            }
            //Удаление файла
            if (unlink($fullPath)) {
                $removeFile++;
            }
        } else {
            $filesCount++;
        }
        $i++;
        $count++;
        unset($fileName, $backTrue);
    }
    closedir($hSubDir);
    //Удалить поддиректорию, если удаление активно и счётчик файлов пустой - т.е каталог пуст
    if ($deleteFiles && !$filesCount) {
        rmdir($subDirPath);
    }
    $contDir++;
}
closedir($hRootDir);

?>