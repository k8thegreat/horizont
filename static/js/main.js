/**
 * Created by Nicholas Sribnyak
 */
document.addEventListener('gesturestart', function (e){
    e.preventDefault();
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

    //Открытие модалки
    $('[data-modal]').on('click', function (e){
        e.preventDefault();
        var id = $(this).data('modal');
        $('#' + id).addClass('open');

        $('.wrapper,footer.footer').css({"filter":"blur(5px)"});
        $('body').addClass('overflow');
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

    $('body').on('click', function (event){
        var target = $( event.target );
        if(target.closest('.drop-wrapper').hasClass('drop-wrapper') && target.closest('.drop-wrapper').hasClass('open')&& target.hasClass('drop-btn')){
            target.closest('.drop-wrapper').removeClass('open');
        }else if(target.closest('.drop-wrapper').hasClass('drop-wrapper')){
            $('.drop-filter .drop-wrapper').removeClass('open');
            target.closest('.drop-wrapper').addClass('open');
        }else {
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
    });

    $('.advanced-search-btn').on('click', function (){
        $(this).toggleClass('open');
        $('.additional-filter').toggleClass('active');
        $('.additional-filter .drop-filter .input-default').removeClass('open');
    });

    $('.menu-btn').on('click', function (){
        $(this).parent().parent().toggleClass('open');
    });

    $('.apartment-group-title, .list-partner-group-title').on('click', function (){
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
            loop:true,
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
function scrollTop(){
    if ($(window).scrollTop() > 400) {
        $('.scroll-top')
            .css({"opacity":"1", "visibility":"visible"})
            .on('click', function (){
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