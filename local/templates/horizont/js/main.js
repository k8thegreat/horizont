/**
 * Created by Nicholas Sribnyak
 */
document.addEventListener('gesturestart', function (e){
    e.preventDefault();
});
jQuery.expr[":"].containsText = jQuery.expr.createPseudo(function(arg) {
    return function( elem ) {
        return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
$(document).ready(function(){
    //scrollMenu();
    subMenu();
    scrollTop();
    fixedFilter();
    showMobFilter();
    textFilterUpdate();
    $(window).on('scroll', function (){
    //     scrollMenu();
        subMenu();
        scrollTop();
        fixedFilter();
    });


    //Sidebar filter
    $('[data-filter]').on('change', function (){
        var $this = $(this);
        var $checkType = $this.data('filter');
        var $checker = $this;
        var $filterId = $checker.attr('id');
        var $filterName = $checker.attr('name');
        var $filterText = $this.parent().find('span').text();
        if($checker.prop("checked") && $checkType === 'checkbox'){
            addFilter($filterId,$filterText,$this);
        }else if($checker.prop("checked") && $checkType === 'radio'){
            filterDate($filterText,$filterName,$this);
        }else if($checker.prop("checked") && $checkType === 'radio_price'){
            filterPrice($this);
            generatorPrice($this);
        }else{
            removeFilter($filterId);
            $('[data-id="'+ $filterId +'"]').remove();
        }
    });

    $('[data-filter]').each(function (){
        var $this = $(this);
        var $checkType = $this.data('filter');
        var $checker = $this;
        var $filterId = $checker.attr('id');
        var $filterName = $checker.attr('name');
        var $filterText = $this.parent().find('span').text();
        if($checker.prop("checked") && $checkType === 'checkbox'){
            addFilter($filterId,$filterText,$this);
        }else if($checker.prop("checked") && $checkType === 'radio'){
            filterDate($filterText,$filterName,$this);
        }
    });
    function addFilter($filterId,$filterText,$this) {
        var filterArray = $('.filters');
        var checkFiltersSpan = filterArray.find('span');

        if(checkFiltersSpan.length < 1){
            filterArray.prepend(
                '<span class="filter-name" data-id="'+ $filterId +'">' + $filterText + '</span>'+
                '<button class="reset-filter">Сбросить</button>'
            );
        }else{
            filterArray.prepend(
                '<span class="filter-name" data-id="'+ $filterId +'">' + $filterText + '</span>'
            );
        }
    }
    function removeFilter($filterId) {
        var filterArray = $('.filters');
        var checkFiltersSpan = filterArray.find('span');

        if(checkFiltersSpan.length > 1){
            filterArray.find('[data-id="'+ $filterId +'"]').remove();
        }else {
            filterArray.children().remove();
        }
    }
    function filterDate($filterText, $filterName,$this) {
        var filterArray = $('.filters');
        var checkFiltersSpan = filterArray.find('span');
        var checkFiltersName = filterArray.find('[data-name="'+ $filterName +'"]');

        checkFiltersName.remove();
        if(checkFiltersSpan.length < 1){
            filterArray.prepend(
                '<span class="filter-name" data-id="'+ $filterName +'" data-name="'+ $filterName +'">' + $filterText + '</span>'+
                '<button class="reset-filter">Сбросить</button>'
            );
        }else{
            filterArray.prepend(
                '<span class="filter-name" data-id="'+ $filterName +'" data-name="'+ $filterName +'">' + $filterText + '</span>'
            );
        }
    }

    $('.price-range').on('click', '[data-filter]' ,function () {
        var $this = $(this);
        var $checker = $this;
        var $filterName = $checker.attr('name');
        var $filterText = $this.parent().find('span').text();
        var price_val  = $("input[name="+$filterName+"]:checked").val();
        $("#"+$filterName+"_input").val(price_val).change();
    });
    $('#price_to_input, #price_do_input').change(function (){
        var $this = $(this);
        var $filterName = $this.attr('name');
        var $filterText = $this.val();

        filterPrice($(this));
        setPriceFilter($(this));
    });
    $('#price_to_input, #price_do_input').each(function (){
        setPriceFilter($(this));
    });
    function filterPrice(input) {
        var filterArray = $('.filters');
        var checkFiltersSpan = filterArray.find('span');
        if(checkFiltersSpan.length < 1){
            filterArray.prepend(
                '<button class="reset-filter">Сбросить</button>'
            );
            setPriceFilter(input);
        }else {
            setPriceFilter(input);
        }
    }
    function setPriceFilter(input){
        var filterArray = $('.filters');
        var filterName = $(input).attr("name");
        var filterText = $(input).val();
        var checkFiltersName = filterArray.find('[data-name="'+ filterName +'"]');
        checkFiltersName.remove();
        if(filterText) {
            if (!filterArray.find('.filter-price').length) {
                filterArray.prepend(
                    '<span class="filter-name filter-price"></span>'
                );
            }
            if ($(input).attr("id") === 'price_to_input') {
                filterArray.find('.filter-price').prepend(
                    '<span data-name="' + filterName + '">от: ' + filterText + ' руб.  </span>'
                );
            } else if ($(input).attr("id") === 'price_do_input') {
                filterArray.find('.filter-price').append(
                    '<span data-name="' + filterName + '">до: ' + filterText + ' руб.</span>'
                );
            }
        }
    }

    function removeButtonReset(){
        var filterArray = $('.filters');
        var checkFiltersSpan = filterArray.children('span');
        if(checkFiltersSpan.length < 1){
            filterArray.children().remove();
        }
    }
    function setSqr(input){
        var filterArray = $('.filters');
        var inputGroupName = $(input).closest('[data-input]').data('input');
        var inputGroupNameText = $(input).closest('[data-input]').find('span').text();
        var dataSqr = filterArray.find('[data-sqr="'+ inputGroupName +'"]');
        var inputVal = $(input).val();

        if(!dataSqr.length > 0){
            filterArray.prepend(
                '<span class="filter-name" data-sqr="'+ inputGroupName +'"></span>'
            );
            dataSqr = filterArray.find('[data-sqr="'+ inputGroupName +'"]');
        }
        dataSqr.find('.valTitle').remove();
        if($(input).hasClass('to')){
            if(inputVal.length){
                dataSqr.find('.valTo').remove();
                dataSqr.prepend(
                    '<span class="valTo">&nbsp;от: ' + inputVal + ' кв.м&nbsp;</span>'
                );
            }else if(inputVal.length === 0 && $(input).next().val().length === 0) {
                dataSqr.remove();
            }
        }else {
            if(inputVal.length){
                dataSqr.find('.valDo').remove();
                dataSqr.append(
                    '<span class="valDo"> до: ' + inputVal + ' кв.м</span>'
                );
            }else if(inputVal.length === 0 && $(input).prev().val().length === 0) {
                dataSqr.remove();
            }
        }
        dataSqr.prepend(
            '<span class="valTitle">'+ inputGroupNameText +'</span>'
        );
    }
    $('body').on('change', '.sqr', function (){
        setSqr($(this));
    });
    $('.sqr').each(function () {
        if($(this).val()){
            setSqr($(this));
        }
    });
    var filterWrapper = $('.filters');
    // Remove all tags and all filter parameter
    filterWrapper.on('click', '.reset-filter', function (){
        filterWrapper.find('span').each(function (){
            $(this).click();
        });
    });
    // Remove tags and filter parameter by one section
    $('.reset-filter-small').on('click' , function (){
        var $wrapper = $(this).closest('.drop-body');
        $('[type="checkbox"]:checked', $wrapper).click();
        $('[type="radio"]:checked', $wrapper).removeAttr('checked').change();
    });
    // Remove checkbox filter tag and filter checkbox
    filterWrapper.on('click', '[data-id]' , function (){
        var $filterId = $(this).data('id');
        $('[name="'+ $filterId +'"][type="checkbox"]:checked').click();
        $('[name="'+ $filterId +'"][type="radio"]:checked').removeAttr('checked').change();
        $('[data-id="'+ $filterId +'"]').remove();
        removeButtonReset();
    });
    // Remove sqr tags and clear input
    filterWrapper.on('click', '[data-sqr]', function () {
        var $this = $(this);
        var $filterId = $(this).data('sqr');
        $this.remove();
        $('[data-input="'+ $filterId +'"]').find('input').val('').change();
        removeButtonReset();
    });
    //Remove filter price tag and checkbox
    filterWrapper.on('click', '.filter-price', function () {
        var $this = $(this);
        $this.remove();
        $('[name="price_to"]:checked').removeAttr('checked').change();
        $('[name="price_do"]:checked').removeAttr('checked').change();
        $('#price_to_input, #price_do_input').val('').change();
        removeButtonReset();
    });
    // Remove radio tags by name (data-name)
    filterWrapper.on('click', '[data-name]', function () {
        var $this = $(this);
        var $filterName = $(this).data('name');
        $this.remove();
        $('[name="'+ $filterName +'"]').removeAttr('checked');
        removeButtonReset();
    });
    //Генератор диапазона цен
    $('#price_to').on('click', '[data-filter]', function (){
        var $this = $(this);
        generatorPrice($this);
        addPriceToInput($this);
    });
    $('#price_do').on('click', '[data-filter]', function (){
        var $this = $(this);
        generatorPrice($this);
        addPriceToInput($this);
    });
    function addPriceToInput($this) {
        var presentValue = $this.find('[data-value]').data('value');
        $this.closest('.drop-content').parent().find('input[type="number"]').val(presentValue);
    }
    function generatorPrice($this) {
        var presentValue = $this.find('[data-value]').data('value');
        var upOrDown = $this.find('input').attr('name');
        var wrapListPrice,listName,$elVal;
        if(upOrDown === 'price_to'){
            wrapListPrice = $('#price_do');
            listName = 'price_do';
            wrapListPrice.children().each(function (){
                var $checker = $(this).find('input');
                if($checker.is(':checked')){
                    $elVal = $(this).find('[data-value]').data('value');
                }
                $(this).remove();
                return $elVal;
            });
            generatorPriceUp(presentValue,wrapListPrice,listName,$elVal);
        }else if(upOrDown === 'price_do'){
            wrapListPrice = $('#price_to');
            listName = 'price_to';
            wrapListPrice.children().each(function (){
                var $checker = $(this).find('input');
                if($checker.is(':checked')){
                    $elVal = $(this).find('[data-value]').data('value');
                }
                $(this).remove();
                return $elVal;
            });
            generatorPriceDown(presentValue,wrapListPrice,listName,$elVal);
        }
    }
    function generatorPriceUp(presentValue, wrapListPrice, listName, $elVal) {
        for(var i=0; i<10 ;i++){
            presentValue = presentValue + 500000;
            wrapListPrice.append(
                '<li>' +
                '<label class="checkbox" data-filter="radio_price">' +
                '<input type="radio" name="'+listName+'" value="'+presentValue+'">' +
                '<span data-value="'+presentValue+'">'+presentValue+'</span>' +
                '</label>' +
                '</li>'
            );
            if(presentValue === $elVal){
                wrapListPrice.find('li:last-child input').prop( "checked", true );
            }
        }
    }
    function generatorPriceDown(presentValue, wrapListPrice, listName, $elVal) {
        for(var i=0; i<10 ;i++){
            presentValue = presentValue - 500000;
            if(presentValue > 0){
                wrapListPrice.prepend(
                    '<li>' +
                    '<label class="checkbox" data-filter="radio_price">' +
                    '<input type="radio" name="'+listName+'" value="'+presentValue+'"ƒ>' +
                    '<span data-value="'+presentValue+'">'+presentValue+'</span>' +
                    '</label>' +
                    '</li>'
                );
            }
            if(presentValue === $elVal){
                wrapListPrice.find('li:first-child input').prop( "checked", true );
            }
        }
    }






    //--end filter--//



    $('.result-sort').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });

    $('.phone').inputmask('+7 (999) 999-99-99',{
        oncomplete: function () {
            $(this).addClass("is-valid");
        },
        onincomplete: function () {
            $(this).removeClass("is-valid");
        }
    });

    $('body').on('click', '.location-tabs .three-filter li a', function(e){
        e.preventDefault();
        var tab = $(this).attr("href").replace("#", "");
        $(".location-tabs .three-filter li a").removeClass("active");
        $(this).addClass("active");
        $(".location-items li").hide();
        $(".location-items li[data-tab="+tab+"]").show();

    });
    $(".location-tabs .three-filter li:first-child a").click();
    $('#location-input').keyup(function(){
        var val = $(this).val();
        $(".location-items li").show();
        if(val !== "") {
            $('.location-items li span:not(:containsText("' + val + '"))').parents('li').hide();
        }
    });
    //Открытие модалки
    $('body').on('click', '[data-modal]', function (e){
        e.preventDefault();
        var id = $(this).data('modal');
        $('#' + id).addClass('open');
        $('.wrapper,footer.footer').css({"filter":"blur(5px)"});
        $('body').addClass('overflow');
    });
    $("body").on("change", "#calc-form .required", function(){
        if($(this).val()) $(this).removeClass("error");
        else $(this).addClass("error");
    });
    $("body").on("change", "#apart-calc-form .required", function(){
        if($(this).val()) $(this).removeClass("error");
        else $(this).addClass("error");
    });
    //Открытие модалки
    $('body').on('click', '.apart-modal', function (e){
        e.preventDefault();
        var href
        if($(this).attr('href')){
            href = $(this).attr('href');
        }else{
            href = $(this).data('href');
        }
        $('#modal-apartment .modal-body-innner').load(href+' #apartment-detail', function () {
            var apart_calc_form_options = {
                type: "post",
                dataType: "json",
                success: function(data){
                    $("#apart-calc-form .btn").prop("disabled", false).removeClass("disabled");
                    if(data.errorstr){
                        $("#apart-calc-form .errors").html(data.errorstr);
                    }else{
                        if(data.success){
                            $("#apart-calc-form .errors").html("");
                            $("#apart-calc-form .price-month").html(data.success);
                        }
                    }
                },
                beforeSubmit: function(){
                    var error = false;
                    $("#apart-calc-form .errors").text();
                    $("#apart-calc-form .required").each(function(){
                        if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                        switch (type) {
                            case 'text':
                            case 'textarea':
                                if(!$(this).val()){
                                    error = true;
                                    $(this).addClass("error");
                                }
                                break;
                        }
                    });

                    if(error == true) {
                        return false;
                    }
                    $("#apart-calc-form .errors").html("");
                    $("#apart-calc-form button").prop("disabled", "disabled").addClass("disabled");
                }
            }
            $('#apart-calc-form').ajaxForm(apart_calc_form_options);
            $('#modal-apartment').addClass('open');
            $('.wrapper,footer.footer').css({"filter":"blur(5px)"});
            $('body').addClass('overflow');
        });
    });
    $('[name="rooms-selector"]').click(function() {
        var total = $('[name="rooms-selector"]').size();
        var items_checked = $('[name="rooms-selector"]:checked').size();
        var checked = $(this).prop("checked");
        var val = $(this).val();
        if(val=="all" && checked) {
            $('[name="rooms-selector"][value!="all"]').prop('checked', false);
        }else if(val=="all" && !checked){
            $('[name="rooms-selector"][value!="all"]').prop('checked', true);
        }
        else if($(this).val()!="all" && items_checked==0){
            $('[name="rooms-selector"][value="all"]').prop('checked', true);
        }
        else if(val!="all") {
            $('[name="rooms-selector"][value="all"]').prop('checked', false);
            if($(this).prop("checked") && $('[name="rooms-selector"][value!="all"]:checked').size()==(total-1)) {
                $('[name="rooms-selector"][value="all"]').prop('checked', true);
                $('[name="rooms-selector"][value!="all"]').prop('checked', false);
            }
        }
        $('[name="rooms-selector"]:checked').each(function() {
            $('[data-rooms="rooms-'+$(this).val()+'"').show();
        });
        $('[name="rooms-selector"]:not(:checked)').each(function() {
            $('[data-rooms="rooms-'+$(this).val()+'"').hide();
        });
        if($('[name="rooms-selector"][value="all"]').prop("checked")){
            $('[data-rooms]').show();
        }
    });
    //Скролл к елементу
    $('[data-scroll]').on('click', function (e){
        e.preventDefault();
        var id = $(this).data('scroll');
        var stop = $('#' + id).offset().top - 43;
        $('body,html').stop(true,true).animate({scrollTop: stop}, 1000);
        return false;
    });

    //Закрытие модалки
    $('.close, .transparent').on('click', function () {
        var closeBtn = $(this).closest('.modal,.modal-message');
        closeBtn.removeClass('open');
        $('.wrapper,footer.footer').css({"filter":"none"});
        $('body').removeClass('overflow');
    });

    $('.drop-nav > button').on('click', function (){
        $(this).parent().find('button').removeClass('active');
        $(this).addClass('active');
    });

    // $('.drop-btn').on('click', function (){
    //     if($(this).parent().hasClass('open')){
    //         $('.drop-filter .input-default').removeClass('open');
    //     }else {
    //         $('.drop-filter .input-default').removeClass('open');
    //         $(this).parent().addClass('open');
    //     }
    // });
$(".tabs, #tabs").tabs({});
    $('.drop-nav > button').on('click', function (){
        $(this).parent().find('button').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });

    $('body').on('click', function (event){
        var target = $( event.target );
        if(target.parents('.drop-wrapper').length>0 && target.parents('.drop-wrapper').hasClass('open') && (target.hasClass('drop-btn') || target.hasClass('btn'))){
            target.closest('.drop-wrapper').removeClass('open');
            event.preventDefault();
        }else if(target.parents('.drop-wrapper').length>0 && !target.parents('.drop-wrapper').hasClass('open') && target.hasClass('drop-btn')){
            $('.drop-filter .drop-wrapper').removeClass('open');
            target.closest('.drop-wrapper').addClass('open');
            event.preventDefault();
        }else if(target.parents('.drop-wrapper').length==0){
            $('.drop-filter .drop-wrapper').removeClass('open');
        }
        if(target.is('.drop-wrapper .btn')){
            $('.drop-wrapper').removeClass('open');
        }
        if(target.is('.detailed-information .btn')){
            $('.detailed-information').children().hide();
            $('.detailed-information').find('.gray-card').show();
        }
        if(target.is('.close-card')){
            $('.detailed-information').children().show();
            $('.detailed-information').find('.gray-card').hide();
        }
        if(target.is("#go-filter button"))
            event.preventDefault();
    });

    $('.close, .transparent').on('click', function () {
        var closeBtn = $(this).closest('.modal,.modal-message');
        closeBtn.removeClass('open');
        $('.wrapper,footer.footer').css({"filter":"none"});
        $('body').removeClass('overflow');
    });


    $('.advanced-search-btn').on('click', function (){
        $(this).toggleClass('open');
        $('.additional-filter').toggleClass('active');
        $('.additional-filter .drop-filter .input-default').removeClass('open');
        return false;
    });

    $('.menu-btn').on('click', function (){
        $(this).parent().parent().toggleClass('open');
    });

    $('body').on('click', '.apartment-group-title, .list-partner-group-title', function (){
        $(this).closest('.apartment-group').toggleClass('open');
        $(this).closest('.list-partner-group').toggleClass('open');
    });


    //sliders
    if($('.viewed-buildings').length > 0){
        $('.viewed-buildings').owlCarousel({
            loop:true,
            margin:35,
            dots:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        });
    }
    if($('.dark-control').length > 0){
        $('.dark-control').owlCarousel({
            loop:true,
            margin:15,
            dots:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            }
        });
    }
    if($('.mortgage').length > 0){
        $('.mortgage').owlCarousel({
            loop:false,
            margin:20,
            dots:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:true,
                }
            }
        });
    }
    if($('.slider-preview').length > 0){
        $('.slider-preview').owlCarousel({
            loop:true,
            dots:true,
            responsiveClass:true,
            items:1,
            nav:false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause:true
        });
    }
});

function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=820,height=650');
    WinPrint.document.write('<html><head><title>Печать</title>' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/template_styles.css">' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/fonts/fonts.css">' +
        '</head><body><div id="print">');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.write('</div></body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    setTimeout(function(){WinPrint.print();WinPrint.close();}, 1000);

}
function scrollTop(){
    if ($(window).scrollTop() > 400) {
        $('.scroll-top')
            .css({"opacity":"1", "visibility":"visible"})
            .on('click', function(){
                $('body,html').stop().animate({scrollTop: 0}, 1000);
                return false;
            });
    } else {
        $('.scroll-top').css({"opacity":"0", "visibility":"hidden"});
    }
}
function scrollMenu() {
    var top = $('html,body').scrollTop();
    if(top < 155){
        $('.header').removeClass('scroll');
    }else {
        $('.header').addClass('scroll');
    }
}
function subMenu() {
    var top = $(window).scrollTop(),
        subMenu = $('.builder-menu');

    if(top > 597){
        subMenu.addClass('fixed');
    }else {
        subMenu.removeClass('fixed');
    }
}
function fixedFilter() {
    var top = $(window).scrollTop(),
        vw = $(window).width(),
        filter = $('.result-list-nav'),
        prev = $('.mobile-prev');

    if(top > 367 && vw < 768){
        filter.addClass('fixed');
    }else {
        filter.removeClass('fixed');
    }

    if(top > 64 && vw < 768){
        prev.addClass('fixed');
    }else {
        prev.removeClass('fixed');
    }
}
function textMod(){
    if($(window).width() < 700){
        $('.one-result.text-mod').parent().css({"flex":"0 0 100%","max-width":"100%"});
    }else {
        $('.one-result.text-mod').parent().css({" ":" "});
    }
}
function showMobFilter(){
    $('.go-filter').on('click', function (e){
        e.preventDefault();
        if($(this).hasClass('open')){
            $(this).removeClass('open');
            $('.mobile-nav-filter, .filter-bar').css({"display":"none"});
        }else {
            $(this).addClass('open');
            $('.mobile-nav-filter').css({"display":"flex"});
            $('.filter-bar').css({"display":"block"});
        }
    });
    $('.filter-back').on('click', function (){
        $('.go-filter').removeClass('open');
        $('.mobile-nav-filter, .filter-bar').css({"display":"none"});
    });

    //mortgage calculator -- start

    $("body").on("change", "#calc-form .required, #apart-calc-form .required", function(){
        if($(this).val()) $(this).removeClass("error");
        else $(this).addClass("error");
    });
    var calc_form_options = {
        type: "post",
        dataType: "json",
        success: function(data){
            $("#calc-form .btn").prop("disabled",false).removeClass("disabled");
            if(data.errorstr){
                $("#calc-form .errors").html(data.errorstr);
            }else{
                if(data.success){
                    $("#calc-form .errors").html("");
                    $("#calc-form .price-month").html(data.success);
                }
            }
        },
        beforeSubmit: function(){
            var error = false;
            $("#calc-form .errors").text();
            $("#calc-form .required").each(function(){
                if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                switch (type) {
                    case 'text':
                    case 'textarea':
                        if(!$(this).val()){
                            error = true;
                            $(this).addClass("error");
                        }
                        break;
                }
            });

            if(error == true) {
                return false;
            }
            $("#calc-form .errors").html("");
            $("#calc-form .btn").prop("disabled", "disabled").addClass("disabled");
        }
    }

    $('#calc-form').ajaxForm(calc_form_options);

    var apart_calc_form_options = {
        type: "post",
        dataType: "json",
        success: function(data){
            $("#apart-calc-form .btn").prop("disabled", false).removeClass("disabled");
            if(data.errorstr){
                $("#calc-form .errors").html(data.errorstr);
            }else{
                if(data.success){
                    $("#apart-calc-form .errors").html("");
                    $("#apart-calc-form .price-month").html(data.success);
                }
            }
        },
        beforeSubmit: function(){
            var error = false;
            $("#apart-calc-form .errors").text();
            $("#apart-calc-form .required").each(function(){
                if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                switch (type) {
                    case 'text':
                    case 'textarea':
                        if(!$(this).val()){
                            error = true;
                            $(this).addClass("error");
                        }
                        break;
                }
            });

            if(error == true) {
                return false;
            }
            $("#apart-calc-form .errors").html("");
            $("#apart-calc-form .btn").prop("disabled", "disabled").addClass("disabled");
        }
    }

    $('#apart-calc-form').ajaxForm(apart_calc_form_options);
    //mortgage calculator -- end

}

function textFilterUpdate(){
    if($(window).width() < 550){
        $('.apartment-group-title > div:nth-child(2) > span').text('от:');
        $('.apartment-group-title > div:nth-child(3) > span').text('от:');
    }else {
        $('.apartment-group-title > div:nth-child(2) > span').text('стоимость  от:');
        $('.apartment-group-title > div:nth-child(3) > span').text('метраж  от:');
    }
}
var charMap = {
    'q' : 'й', 'w' : 'ц', 'e' : 'у', 'r' : 'к', 't' : 'е', 'y' : 'н', 'u' : 'г', 'i' : 'ш', 'o' : 'щ', 'p' : 'з', '[' : 'х', ']' : 'ъ', 'a' : 'ф', 's' : 'ы', 'd' : 'в', 'f' : 'а', 'g' : 'п', 'h' : 'р', 'j' : 'о', 'k' : 'л', 'l' : 'д', ';' : 'ж', '\'' : 'э', 'z' : 'я', 'x' : 'ч', 'c' : 'с', 'v' : 'м', 'b' : 'и', 'n' : 'т', 'm' : 'ь', ',' : 'б', '.' : 'ю','Q' : 'Й', 'W' : 'Ц', 'E' : 'У', 'R' : 'К', 'T' : 'Е', 'Y' : 'Н', 'U' : 'Г', 'I' : 'Ш', 'O' : 'Щ', 'P' : 'З', '[' : 'Х', ']' : 'Ъ', 'A' : 'Ф', 'S' : 'Ы', 'D' : 'В', 'F' : 'А', 'G' : 'П', 'H' : 'Р', 'J' : 'О', 'K' : 'Л', 'L' : 'Д', ';' : 'Ж', '\'' : 'Э', 'Z' : '?', 'X' : 'ч', 'C' : 'С', 'V' : 'М', 'B' : 'И', 'N' : 'Т', 'M' : 'Ь', ',' : 'Б', '.' : 'Ю',
};
function toTranslit(text) {
    return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
        function (all, ch, space, words, i) {
            if (space || words) {
                return space ? '-' : '';
            }
            var code = ch.charCodeAt(0),
                index = code == 1025 || code == 1105 ? 0 :
                    code > 1071 ? code - 1071 : code - 1039,
                t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                    'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                    'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                    'shch', '', 'y', '', 'e', 'yu', 'ya'
                ];
            return t[index];
        });
}
function changeKeyboardLayout(str){
    var r = '';
    for (var i = 0; i < str.length; i++) {
        r += charMap[str.charAt(i)] || str.charAt(i);
    }
    return r;
}
function testValue(item, term){
    if (-1 < item.toUpperCase().indexOf(term.toUpperCase())) {
        return true;
    }else{
        if(-1 < item.toUpperCase().indexOf(changeKeyboardLayout(term.toUpperCase()))){
            return true;
        }
        else {
            if (-1 < toTranslit(item).indexOf(term))
                return true;
        }
    }
    return false;
}
$(document).ready(function(){
    $(".tablesorter").tablesorter( {sortList: [[8,0], [9,0]]} );
    $("body").on("click", ".ui-autocomplete .ui-menu-item-wrapper", function () {
        $("#autocomplete").val("");

    });
    }
);