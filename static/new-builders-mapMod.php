<?php include '_header.php'; ?>
    <section class="builder-small-slide shadow" style="background-image: url(img/builders/slide-bg.png);">
        <ul class="breadcrumbs">
            <li><a href="">Главная</a></li>
            <li>Новостройки</li>
        </ul>
        <div class="container">
            <h1 class="title-big">поиск новостроек <strong>в Петербурге и Ленинградской области</strong></h1>
        </div>
    </section>
    <section class="filter-bar-wrapper bg-gray" id="go-filter">
        <?php include '_filter.php'; ?>
    </section>
    <section class="bg-gray">
        <div class="container">
            <h2 class="title-big cursive-title-top-center"><span class="dop-title">Все новостройки</span>петербурга
                и ленобласти</h2>
            <div class="result-list map-mod">
                <div class="result-list-nav">
                    <div>
                        <a href="" class="go-filter">Фильтр
                            <svg class="svg-result-sort" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 612.006 612.006" xml:space="preserve">
                                <path d="M292.911,318.872H14.833C6.639,318.872,0,312.232,0,304.04c0-8.194,6.639-14.833,14.833-14.833h278.078
                                    c8.194,0,14.833,6.639,14.833,14.833C307.744,312.232,301.105,318.872,292.911,318.872z"/>
                                <path d="M597.167,318.872H449.638c-8.193,0-14.833-6.64-14.833-14.833c0-8.194,6.64-14.833,14.833-14.833h147.529
                                    c8.193,0,14.833,6.639,14.833,14.833C612,312.232,605.36,318.872,597.167,318.872z"/>
                                <path d="M214.545,506.712H14.833C6.639,506.712,0,500.072,0,491.88c0-8.193,6.639-14.834,14.833-14.834h199.712
                                    c8.194,0,14.833,6.641,14.833,14.834C229.378,500.072,222.739,506.712,214.545,506.712z"/>
                                <path d="M597.167,506.712H371.266c-8.193,0-14.833-6.64-14.833-14.833c0-8.192,6.64-14.833,14.833-14.833h225.901
                                    c8.193,0,14.833,6.641,14.833,14.833C612,500.072,605.36,506.712,597.167,506.712z"/>
                                <path d="M129.368,134.96H14.833C6.639,134.96,0,128.32,0,120.127s6.639-14.833,14.833-14.833h114.535
                                    c8.193,0,14.833,6.639,14.833,14.833S137.562,134.96,129.368,134.96z"/>
                                <path d="M597.167,134.96H286.1c-8.194,0-14.833-6.639-14.833-14.833s6.639-14.833,14.833-14.833h311.073
                                    c8.193,0,14.833,6.639,14.833,14.833C612,128.32,605.36,134.96,597.167,134.96z"/>
                                <path d="M175.635,181.215c-33.695,0-61.101-27.406-61.101-61.1c0-33.683,27.406-61.089,61.101-61.089
                                    c33.683,0,61.088,27.406,61.088,61.089C236.718,153.81,209.312,181.215,175.635,181.215z M175.635,88.693
                                    c-17.331,0-31.434,14.097-31.434,31.422c0,17.331,14.103,31.434,31.434,31.434c17.325,0,31.422-14.104,31.422-31.434
                                    C207.052,102.791,192.954,88.693,175.635,88.693z"/>
                                <path d="M257.709,552.979c-33.695,0-61.1-27.406-61.1-61.102c0-33.688,27.405-61.095,61.1-61.095
                                    c33.689,0,61.094,27.406,61.094,61.095C318.798,525.573,291.393,552.979,257.709,552.979z M257.709,460.45
                                    c-17.331,0-31.434,14.099-31.434,31.43c0,17.33,14.103,31.435,31.434,31.435s31.428-14.104,31.428-31.435
                                    C289.137,474.549,275.035,460.45,257.709,460.45z"/>
                                <path d="M339.173,365.121c-33.689,0-61.095-27.404-61.095-61.094c0-33.683,27.406-61.089,61.095-61.089
                                    c33.688,0,61.094,27.406,61.094,61.089C400.267,337.716,372.861,365.121,339.173,365.121z M339.173,272.605
                                    c-17.331,0-31.429,14.097-31.429,31.422c0,17.331,14.098,31.428,31.429,31.428s31.428-14.097,31.428-31.428
                                    C370.601,286.702,356.504,272.605,339.173,272.605z"/>
                            </svg>
                        </a>
                        <select name="" class="result-sort">
                            <option value="" selected>Сортировать</option>
                            <option value="">По имени</option>
                            <option value="">По дате</option>
                            <option value="">По цене</option>
                        </select>
                        <a href="new-builders-lineMod.php" class="list list-line">
                            <svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M0 1h3v2h-3v-2z"></path>
                                <path d="M0 5h3v2h-3v-2z"></path>
                                <path d="M0 9h3v2h-3v-2z"></path>
                                <path d="M0 13h3v2h-3v-2z"></path>
                                <path d="M4 1h12v2h-12v-2z"></path>
                                <path d="M4 5h12v2h-12v-2z"></path>
                                <path d="M4 9h12v2h-12v-2z"></path>
                                <path d="M4 13h12v2h-12v-2z"></path>
                            </svg>
                        </a>
                        <a href="new-builders.php" class="list list-squares">
                            <svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16" height="16"
                                 viewBox="0 0 278 278" style="enable-background:new 0 0 278 278;" xml:space="preserve">
                        <g>
                            <rect x="0" y="0" width="119.054" height="119.054"/>
                            <rect x="158.946" y="0" width="119.054" height="119.054"/>
                            <rect x="158.946" y="158.946" width="119.054" height="119.054"/>
                            <rect x="0" y="158.946" width="119.054" height="119.054"/>
                        </g>
                    </svg>
                        </a>
                        <a href="new-builders-mapMod.php" class="list list-map active">
                            <svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16" height="16"
                                 viewBox="0 0 54.757 54.757" style="enable-background:new 0 0 54.757 54.757;" xml:space="preserve">
                        <path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952
                        L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M27.557,26c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7
                        S31.416,26,27.557,26z"/>
                    </svg>
                        </a>
                    </div>
                </div>
                <div class="map-result">
                    <div class="one-result">
                        <div class="result-content-top">
                            <div>
                                <h2 class="name-rc">ЖК «Северный вальс»</h2>
                                <h4 class="name-loc">Всеволожский район</h4>
                            </div>
                            <div>
                                <div class="loc-metro">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="14px" height="14px" viewBox="0 0 94.69 94.691" xml:space="preserve" fill="#f10138">
                                        <g>
                                            <path d="M62.695,10.642l-15.35,48.393L31.996,10.642C13.737,16.918,0,33.943,0,53.461c0,11.756,4.796,22.597,12.555,30.587h22.254
                                                l2.333-10.117C10.556,63.514,15.583,31.235,25.221,25.966C26.365,26.31,43.129,83.81,43.129,83.81c0.229,0,0.973,0,1.882,0
                                                c0.192,0,0.915,0,1.816,0c0.326,0,0.678,0,1.035,0c0.612,0,1.247,0,1.815,0c0.91,0,1.653,0,1.883,0c0,0,16.765-57.5,17.908-57.844
                                                c9.639,5.269,14.664,37.548-11.922,47.965l2.334,10.117h22.254c7.76-7.99,12.556-18.831,12.556-30.587
                                                C94.69,33.943,80.953,16.918,62.695,10.642z"/>
                                        </g>
                                    </svg>
                                    Площадь Ленина
                                </div>
                                <div class="loc-data">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="14px" height="14px" viewBox="0 0 97.16 97.16" fill="#d4d4d5" xml:space="preserve">
                                        <g>
                                            <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823
                                                c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>
                                            <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832
                                                c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>
                                        </g>
                                    </svg>
                                    15 мин
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 93.646 93.646" fill="#d4d4d5" xml:space="preserve" width="14px" height="14px">
                                        <g>
                                            <path d="M67.971,49.778l-9.378-10.345c-0.584-0.644-1.121-1.971-1.148-2.841L57.1,25.858v-0.311c0-1.654-1.346-3-3-3h-9.18h-3.648   c-1.478,0-3.127,1.047-3.756,2.384l-12.358,26.25c-0.342,0.728-0.376,1.541-0.096,2.292c0.28,0.75,0.84,1.342,1.575,1.666   l1.821,0.803c0.388,0.171,0.802,0.258,1.231,0.258h0c1.177,0,2.273-0.669,2.794-1.704l5.789-11.517v11.576   c-0.024,0.067-0.059,0.128-0.081,0.196l-9.783,30.638c-0.407,1.276-0.283,2.619,0.35,3.781s1.693,1.994,2.987,2.343l0.654,0.177   c0.428,0.116,0.872,0.175,1.318,0.175c2.251,0,4.296-1.481,4.974-3.603l9.141-28.628l3.242,7.941   c0.791,1.937,1.645,5.329,1.865,7.409l1.551,14.621c0.249,2.341,2.1,4.04,4.402,4.04c0.377,0,0.76-0.046,1.137-0.137l0.659-0.16   c2.624-0.635,4.478-3.331,4.133-6.008l-2.297-17.828c-0.292-2.265-1.269-5.812-2.178-7.907l-3.102-7.144   c-0.04-0.093-0.097-0.177-0.143-0.267v-4.841l5.59,5.836c0.556,0.581,1.3,0.901,2.094,0.901c0.803,0,1.553-0.326,2.111-0.918   l1.034-1.098C69.036,52.899,69.055,50.973,67.971,49.778z"/>
                                            <path d="M48.52,20.005c5.516,0,10.003-4.487,10.003-10.003C58.523,4.487,54.036,0,48.52,0c-5.515,0-10.001,4.487-10.001,10.002   C38.518,15.518,43.005,20.005,48.52,20.005z"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="" class="thumb">
                            <img src="img/builders/1.jpg" alt="">
                        </a>
                        <div class="result-content">
                            <div class="result-dop-con">
                                <ul class="left-con">
                                    <li><span>Сроки сдачи:</span> <b>II кв. 2018 г. — IV кв. 2019</b></li>
                                    <li><span>Варианты оплаты:</span> <b>Рассрочка, Ипотека</b></li>
                                    <li><span>Застройщик:</span> <b>Петрострой </b></li>
                                </ul>
                                <ul class="right-con">
                                    <li><span>Студии от:</span> <b>1 066 000 руб.</b></li>
                                    <li><span>1 ком. от:</span> <b>1 800 000 руб.</b></li>
                                    <li><span>2 ком. от:</span> <b>2 830 000 руб.</b></li>
                                    <li><span>3 ком. от:</span> <b>4 830 000 руб.</b></li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-center">
                            <a href="" class="btn btn-full">Заказать бесплатную консультацию</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" class="ya-map"></div>
    </section>
    <section>
        <div class="container">
            <h2 class="title-big cursive-title-left">просмотренные новостройки<span class="title-top"><span class="dop-title">История</span></span></h2>
            <div class="viewed-buildings owl-carousel owl-theme">
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
                <div class="item">
                    <a href="" class="thumb">
                        <img src="img/builders/12.jpg" alt="">
                    </a>
                    <div class="carousel-content">
                        <h4>ЖК Кировоград посад</h4>
                        <p>от 1 066 000 руб.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        var myMap;
        ymaps.ready(init); // Ожидание загрузки API с сервера Яндекса
        function init () {

            myMap = new ymaps.Map("map", {
                center: [59.958666, 30.351361], // Координаты центра карты
                zoom: 12 // Zoom
            });

            myMap.controls.add('mapTools', { top: 5, right: 5});
            myMap.controls.add('zoomControl', { top: 40, right: 7 });
        }
    </script>



    <!--<script>
        function initMap() {
            // Styles a map in night mode.
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                scrollwheel: false,
                center: new google.maps.LatLng(59.958666, 30.351361),
                mapTypeControl: true,
                scaleControl: true,
                draggable: true
            });

            var icons = {
                icoDefault: {
                    icon: 'img/svg-icons/show-on-map/placeholder.svg'
                }
            };

            var features = [
                {
                    position: new google.maps.LatLng(59.970928, 30.361568),
                    type: 'icoDefault'
                }, {
                    position: new google.maps.LatLng(59.967863, 30.387698),
                    type: 'icoDefault'
                }, {
                    position: new google.maps.LatLng(59.973788, 30.410562),
                    type: 'icoDefault'
                }, {
                    position: new google.maps.LatLng(59.987269, 30.423627),
                    type: 'icoDefault'
                }, {
                    position: new google.maps.LatLng(60.005848, 30.374633),
                    type: 'icoDefault'
                }
            ];

            // Create markers.
            features.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map
                });
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASkfYVzpyYXGeQs8DdDUZToVvrP66Jtq0&callback=initMap" async defer></script>-->
<?php include '_footer.php'; ?>