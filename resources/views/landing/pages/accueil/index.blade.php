@extends('components.app')
@section('title')
    Accueil
@endsection
@section('page_css')
<link rel="preload" href="/landing/css/home.css" as="style">
<link href="/landing/css/home.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/landing/revolution-slider/fonts/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="/landing/revolution-slider/css/settings.css">
<link rel="stylesheet" type="text/css" href="/landing/revolution-slider/css/layers.css">
<link rel="stylesheet" type="text/css" href="/landing/revolution-slider/css/navigation.css">
<style type="text/css">
    .tiny_bullet_slider .tp-bullet:before {
        content: " ";
        position: absolute;
        width: 100%;
        height: 25px;
        top: -12px;
        left: 0px;
        background: transparent
    }
    .bullet-bar.tp-bullets:before {
        content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        background: transparent;
        padding: 10px;
        margin-left: -10px;
        margin-top: -10px;
        box-sizing: content-box
    }
    .bullet-bar .tp-bullet {
        width: 60px;
        height: 3px;
        position: absolute;
        background: #aaa;
        background: rgba(204, 204, 204, 0.5);
        cursor: pointer;
        box-sizing: content-box
    }
    .bullet-bar .tp-bullet:hover,
    .bullet-bar .tp-bullet.selected {
        background: rgba(204, 204, 204, 1)
    }
</style>
@endsection
@section('main_content')
@include('landing.pages.accueil.layouts.hero_section')
@include('landing.pages.accueil.layouts.popular_resto')
@include('landing.pages.accueil.layouts.popular_event')
@include('landing.pages.accueil.layouts.infos_banner')
@include('landing.pages.accueil.layouts.popular_offers')
@include('landing.pages.accueil.layouts.cta_section')
@endsection
@section('page_js')
<script src="/landing/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="/landing/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script src="/landing/revolution-slider/js/extensions/revolution.addon.slicey.min.js"></script>
<script>
    var tpj = jQuery;
    var revapi45;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_45_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_45_1");
        } else {
            revapi45 = tpj("#rev_slider_45_1").show().revolution({
                sliderType: "standard",
                jsFileLocation: "revolution/js/",
                sliderLayout: "fullscreen",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    mouseScrollReverse: "default",
                    onHoverStop: "off",
                    bullets: {
                        enable: true,
                        hide_onmobile: false,
                        style: "bullet-bar",
                        hide_onleave: false,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 0,
                        v_offset: 50,
                        space: 5,
                        tmp: ''
                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1240, 1024, 778, 480],
                gridheight: [868, 768, 960, 720],
                lazyType: "none",
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                fullScreenAutoWidth: "off",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "0px",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
        if (revapi45) revapi45.revSliderSlicey();
    });
</script>
@endsection
