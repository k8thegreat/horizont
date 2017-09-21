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


    $(".smartfilter .checkbox").each(function(index){
        var $this = $(this);
        var $checker = $this.find('input');
        var $checkbox = $checker.attr('type');
        var filterName = $this.find('[data-name]').data('name');
        var filterText = $this.find('[data-name]').text();
        var selectFilters = $this.closest('.filter-bar').find('.filters');
        var selectFiltersSpan = $this.closest('.filter-bar').find('.filters span');


        if($checker.prop("checked") && $checkbox === 'checkbox'){
            if(selectFiltersSpan.length < 1){
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'+
                    '<button class="reset-filter">Сбросить все</button>'
                );
            }else{
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'
                );
            }
        }else if($checker.prop("checked") && $checkbox === 'radio'){
            selectFilters.find('[data-filter-name="'+ filterName +'"]').remove();
            if(selectFiltersSpan.length < 1){
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'+
                    '<button class="reset-filter">Сбросить все</button>'
                );
            }else{
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'
                );
            }
        }

    });
    //Sidebar filter
    $('.checkbox').on('change', function (){
        var $this = $(this);
        var $checker = $this.find('input');
        var $checkbox = $checker.attr('type');
        var filterName = $this.find('[data-name]').data('name');
        var filterText = $this.find('[data-name]').text();
        var selectFilters = $this.closest('.filter-bar').find('.filters');
        var selectFiltersSpan = $this.closest('.filter-bar').find('.filters span');


        if($checker.prop("checked") && $checkbox === 'checkbox'){
            if(selectFiltersSpan.length < 1){
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'+
                    '<button class="reset-filter">Сбросить все</button>'
                );
            }else{
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'
                );
            }
        }else if($checker.prop("checked") && $checkbox === 'radio'){
            selectFilters.find('[data-filter-name="'+ filterName +'"]').remove();
            if(selectFiltersSpan.length < 1){
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'+
                    '<button class="reset-filter">Сбросить все</button>'
                );
            }else{
                selectFilters.prepend(
                    '<span class="filter-name" data-filter-name="'+ filterName +'">' + filterText + '</span>'
                );
            }
        }else{
            if(selectFiltersSpan.length > 1){
                selectFilters.find('[data-filter-name="'+ filterName +'"]').remove();
            }else{
                selectFilters.children().remove();
            }
        }
    });
    $('body').on('click', '.filter-name[data-filter-name]', function (e){
        e.preventDefault();
        var control = $(this).data('filter-name');
        var $this = $(this);
        var selectFilters = $this.closest('.filter-bar').find('.filters');
        var selectFiltersSpan = $this.closest('.filter-bar').find('.filters span');
        if(control === 'arrFilter_63'){
            $('[name="'+ control +'_MAX"]').attr('checked', false);
            $(this).remove();
        }else{
            $('[name="'+ control +'"]').trigger('click');
        }
        if(selectFiltersSpan.length == 1){
            selectFilters.find(".reset-filter").remove();
        }

    });
    $('body').on('click', '.additional-filter-nav .reset-filter, .filters .reset-filter', function (e){
        e.preventDefault();
        var selectFilters = $(this).closest('.filter-bar').find('.filters');
        $(this).closest('.filter-bar-bottom').find('.filters .filter-name').trigger('click');
        selectFilters.children().remove();
    });
    $('.drop-body .reset-filter').on('click', function (){
        var control = $(this).data('filter-name');
        if(control === 'arrFilter_63'){
            $(this).closest('.filter-bar').find('.drop-list [data-name="'+ filterName +'_MAX"]').trigger('click');
        }else{
            $(this).closest('.drop-body').find('.drop-list > li').each(function (){
                var checker = $(this).find('input');
                if(checker.prop("checked")){
                    $(this).find('[data-name]').trigger('click');
                }
            });
        }
    });

    $('.result-sort').on('change', function () {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });

    $('.phone').mask('+7 (000) 000-00-00', {
        onKeyPress: function(cep, event, currentField, options){
            if(cep.length<3) currentField.val("+7 ");
        }
    });

    $('.location-filter-input').keyup(function(){
        var val = $(this).val();
        var container = $(this).parents(".location-items").find(".drop-list");
        $("li ",container).removeClass('hidden');
        if(val !== "") {
            $('li span:not(:containsText("' + val + '"))', container).parents('li').addClass('hidden');

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
    $('.apart-modal').on('click', function (e){
        e.preventDefault();
        var href = $(this).attr('href');
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
        if($(this).val()=="all" && $(this).prop("checked")) {
            $('[name="rooms-selector"][value!="all"]').prop('checked', false);
        }else if($(this).val()=="all" && !$(this).prop("checked")){
            $('[name="rooms-selector"][value!="all"]').prop('checked', true);
        }
        else if($(this).val()!="all") {
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
$(".tabs").tabs({});
    $('body').on('click', function (event){
        var target = $( event.target );
        if(target.closest('.drop-wrapper').hasClass('drop-wrapper') && target.closest('.drop-wrapper').hasClass('open')&& target.hasClass('drop-btn')){
            target.closest('.drop-wrapper').removeClass('open');
            return false;
        }else if(target.hasClass('drop-btn') && target.closest('.drop-wrapper').hasClass('drop-wrapper')){
            $('.drop-filter .drop-wrapper').removeClass('open');
            target.closest('.drop-wrapper').addClass('open');
            return false;
        }else if(target.hasClass('drop-btn')) {
            //$('.drop-filter .drop-wrapper').removeClass('open');
            //return false;
        }
        if(target.is('.drop-wrapper .btn')){
            $('.drop-wrapper').removeClass('open');
            return false;
        }
        if(target.is('.detailed-information .show-calc')){
            $('.detailed-information').children().hide();
            $('.detailed-information').find('.gray-card').show();
            return false;
        }
        if(target.is('.close-card')){
            $('.detailed-information').children().show();
            $('.detailed-information').find('.gray-card').hide();
            return false;
        }

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

    $('.full-map').on('click', function (){
        if($(this).parent().hasClass('full')){
            $(this).parent().removeClass('full');
        }else {
            $(this).parent().addClass('full');
        }

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
                    loop:true
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
function CallPrint(strid) {
    var prtContent = document.getElementById(strid);
    var prtCSS = '';
    var WinPrint = window.open('','','left=50,top=50,width=900,height =640,toolbar=0,scrollbars=1,status=0');
    WinPrint.document.write('<html><head><title>Печать</title>' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/template_styles.css">' +
        '<link rel="stylesheet" type="text/css" href="/local/templates/horizont/fonts/fonts.css">' +
        '</head><body><div id="print">');
    var print = document.createElement("div");
    print.setAttribute("id", "print");
    print.appendChild(prtContent.cloneNode(true));
    WinPrint.document.body.appendChild(print);
    WinPrint.document.write('</div></body></html>');
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
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

$(document).ready(function() {
    $(".tablesorter").tablesorter( {sortList: [[0,0], [1,0]]} );
    }
);