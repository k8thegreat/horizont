<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
?>
<script type="text/javascript">
    ymaps.ready(init);
    var map, locPlacemark;
    function init(){
        map = new ymaps.Map ("contact-map", {
            center: [<?=$arResult["POSITION"]["yandex_lat"]?>, <?=$arResult["POSITION"]["yandex_lon"]?>],
            zoom: <?=$arResult["POSITION"]["yandex_scale"]?>,
            controls:[]
        });
        map.controls.add("fullscreenControl", {float:'none', position:{top:6,right:6}});
        map.controls.add("zoomControl", {float:'none', position:{top:74,right:6}});
        map.controls.add("rulerControl", {float:'none', position:{top:40,right:6}});
        map.behaviors.disable('scrollZoom');
        <?
        foreach ($arResult["POSITION"]["PLACEMARKS"] as $i => $placemark){
        ?>
        locPlacemark<?=$i?> = new ymaps.Placemark([<?=$placemark["LAT"]?>, <?=$placemark["LON"]?>], {
            hintContent: '<?=$placemark["TEXT"]?>'
        },{
            iconLayout: 'default#image',
            iconImageHref: '/images/map-icon.png',
            iconImageSize: [35, 44],
            iconImageOffset: [-17, -44]
        });
        map.geoObjects.add(locPlacemark<?=$i?>);
        <?}?>
        <?if(count($arResult["PLACEMARKS"])>1){?>
        map.setBounds(map.geoObjects.getBounds());
        <?}?>
    }
</script>
<div id="contact-map" class="ya-map shadow-map">
    <div class="full-map">
        <svg version="1.1" class="full-size" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 79.124 79.124" xml:space="preserve">
            <g>
                <path d="M47.624,0.124l12.021,9.73L44.5,24.5l10,10l14.661-15.161l9.963,12.285v-31.5H47.624z M24.5,44.5
                                    L9.847,59.653L0,47.5V79h31.5l-12.153-9.847L34.5,54.5L24.5,44.5z"/>
            </g>
        </svg>
    </div>
</div>