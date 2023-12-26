
let frontend = {

    init: function () {
        this.headerScroll();
        this.events();
    },

    headerScroll: function(){
        if ($(window).scrollTop() > 60) {
            $(".header").addClass("fixed-nav");
        } else {
            $(".header").removeClass("fixed-nav");
        }
    },

    events: function(){
        let self = this;

        $(window).scroll(function () {
            self.headerScroll();
        });


        $(document).on('click', '.menu-main .drop', function (e) {
            if ($(window).width() < 991) {
                console.log('casd');
                $(this).find('.drop-menu').slideToggle();
                $(this).toggleClass('toggled');
            }
        });

        $(document).on('click', '.sm-drop', function (e) {
            if ($(window).width() < 991) {
                e.preventDefault();     // stop the default action if u need
            }
        });



        $(document).on('click', '.go-down', function () {
            $("html, body").animate({scrollTop: $('#homes').offset().top - 185}, 1000);
        });

        $(document).on('click', '.nav-menu', function () {
            $('.nav-menu').hide();
            $('.nav-close').show();
            $('.menu-main').slideDown("slow");
        });

        $(document).on('click', '.nav-close', function () {
            $('.nav-menu').show();
            $('.nav-close').hide();
            $('.menu-main').slideUp("slow");
        });

        $(document).on('click', '.footer__title', function () {
            if ($(window).width() < 768) {
                $(this).closest('.footer__column').toggleClass('active');
                $(this).closest('.footer__column').find('.footer__hidden').slideToggle();
            }
        });

        $(document).on('click', '.servis-left', function (e) {
            e.preventDefault();
            $('.servis-sidebar-list').animate({
                scrollLeft: '-=100'
            }, 300);
        });

        $(document).on('click', '.servis-right', function (e) {
            e.preventDefault();
            $('.servis-sidebar-list').animate({
                scrollLeft: '+=100'
            }, 300);
        });

        // lang dropdown
        $(document).on('click', '.sort1', function (e) {
            e.preventDefault();
            $('.sort1-m').toggle();
        });

        $(document).on('click', '.sort2', function (e) {
            e.preventDefault();
            $('.sort-other1').toggle();
        });
        // lang dropdown

        $(document).on('click', '.tabs__item', function (){
            $('.tabs__item').removeClass('active');
            $(this).addClass('active');
        });

        $(document).on('click', '#tab-links1', function (){
            $('#tab-1').show();
            $('#tab-2').hide();
            $('#tab-3').hide();
            $('#tab-4').hide();
        });
        $(document).on('click', '#tab-links2', function (){
            $('#tab-2').show();
            $('#tab-1').hide();
            $('#tab-3').hide();
            $('#tab-4').hide();
        });
        $(document).on('click', '#tab-links3', function (){
            $('#tab-3').show();
            $('#tab-1').hide();
            $('#tab-2').hide();
            $('#tab-4').hide();
        });
        $(document).on('click', '#tab-links4', function (){
            $('#tab-4').show();
            $('#tab-1').hide();
            $('#tab-3').hide();
            $('#tab-2').hide();
        });

        $(document).on("click", ".page-scroll", function (a) {
            a.preventDefault();
            // $("html, body").animate({scrollTop: $('#t-scroll-1').offset().top - 100}, 800)
            $("html, body").animate({scrollTop: $($.attr(this, "href")).offset().top - 100}, 800);
        });

        $(document).on("click", ".to_top", function () {
            $('.card-text').animate({
                scrollTop: '-=100'
            }, 300);
        });
        $(document).on("click", ".to_bottom", function () {
            $('.card-text').animate({
                scrollTop: '+=100'
            }, 300);
        });

        $(document).on("click", ".t-sidebar-left", function (e) {
            e.preventDefault();
            $('.types-sidebar ul').animate({
                scrollLeft: '-=100'
            }, 'slow');
        });
        $(document).on("click", ".t-sidebar-right", function (e) {
            e.preventDefault();
            $('.types-sidebar ul').animate({
                scrollLeft: '+=100'
            }, 'slow');
        });

    }
};

let skrollParallax = {
    init: function(){
        this.initSkrollr();
    },
    initSkrollr: function(){
        if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && $(window).width() > 1024) {
            let s = skrollr.init({
                forceHeight: false
            });
        }
    }
};

let modal = {

    init: function () {
        this.events();
    },

    events: function(){
        let self = this;

        $(document).on('click', '.popup-link', function (e) {
            e.preventDefault();
            let popup = $('#popup');
            let t = $(this);
            popup.show();
            popup.find('.js-modal-title').text(t.data('title'));
            popup.find('.js-modal-txt').text(t.data('description'));
            popup.find('.js-modal-btn').text(t.data('button_name'));
            popup.find('#popup-form')[0].action = popup.find('#popup-form').data('action') + '/' +t.data('type');
            $('#popup_wrap').removeClass('animate-away').addClass('animate-in');
        });

        $(window).bind("click touchstart", function (event) {
            if (event.target === document.getElementById('popup')) {
                $('#popup_wrap').removeClass('animate-in').addClass('animate-away');
                setTimeout(function () {
                    document.getElementById('popup').style.display = "none";
                }, 450);
            }
        });

        $(window).bind("click touchstart", function (event) {
            if (event.target == document.getElementById('popup_answer')) {
                // window.location.reload();
                $('#popup_answer_wrap').removeClass('animate-in');
                $('#popup_answer_wrap').addClass('animate-away');
                setTimeout(function () {
                    modal_answer.style.display = "none";
                }, 450);
            }
        });

        $(document).on('click', '.close-modal', function (e) {
            // window.location.reload();
            $('#popup_answer_wrap').removeClass('animate-in');
            $('#popup_answer_wrap').addClass('animate-away');
            setTimeout(function () {
                document.getElementById('popup_answer').style.display = "none";
            }, 450);
        });

    }
};

let flicky = {

    selectedCell: 0,

    slider_options_default: {
        wrapAround: true,
        pageDots: false,
        prevNextButtons: true,
        autoPlay: false,
        cellAlign: 'left',
        contain: true,
        imagesLoaded: true
    },

    init: function () {


        // this.newSlider('.carousel',{arrowShape: {
        //         x0: 10,
        //         x1: 55, y1: 40,
        //         x2: 60, y2: 35,
        //         x3: 20
        //     }});
        //

    },


    newSlider: function (selector, options) {
        options = (options !== undefined) ? Object.assign({}, this.slider_options_default, options) : this.slider_options_default;
        var carousel = new Flickity(document.querySelector(selector), options);
        return new Flickity(document.querySelector(selector), options);
    },

};




//tabs
function openTab(element) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    var tabId = $(element)[0].dataset.target;
    document.getElementById(tabId).style.display = "block";
    element.className += " active";
}//tabs



jQuery(function () {
    frontend.init();
    modal.init();
    flicky.init();
});
