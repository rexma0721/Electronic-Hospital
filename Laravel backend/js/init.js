/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 89);
/******/ })
/************************************************************************/
/******/ ({

/***/ 89:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(90);


/***/ }),

/***/ 90:
/***/ (function(module, exports) {

$(function () {
    var _this = this;

    $('.carousel.carousel-slider').carousel({ full_width: true });
    $('.carousel').carousel();
    $('.slider').slider({ full_width: true });
    $('.parallax').parallax();
    $('.forge-modal').modal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({ 'edge': 'left' });
    $('.datepicker').pickadate({ selectYears: 20 });
    $('select.forge-select').not('.disabled').material_select();

    $('input.autocomplete').autocomplete({
        data: { "Apple": null, "Microsoft": null, "Google": 'http://placehold.it/250x250' }
    });

    $('.chips').material_chip();

    $('.chips-initial').material_chip({
        readOnly: true,
        data: [{
            tag: 'Apple'
        }, {
            tag: 'Microsoft'
        }, {
            tag: 'Google'
        }]
    });

    $('.chips-placeholder').material_chip({
        placeholder: 'Enter a tag',
        secondaryPlaceholder: '+Tag'
    });

    // Swipeable Tabs Demo Init
    if ($('#tabs-swipe-demo').length) {
        $('#tabs-swipe-demo').tabs({ 'swipeable': true });
    }

    document.addEventListener("DOMSubtreeModified", function (e) {
        if ($('#sidenav-overlay').length === 0) {
            $('.mob-menu').removeClass('leftArrow').addClass('menu');
        } else {
            $('.mob-menu').removeClass('menu').addClass('leftArrow');
        }
    }, false);

    $("#rsb-tasklist div.tab-notelist").sortable({
        placeholder: "ui-state-highlight"
    });

    $("#rsb-tasklist div.tab-notelist").disableSelection();

    //  MATERIALIZED INIT
    $('select.mat_select').material_select();
    $('.theme-tooltipped').tooltip({ delay: 50 });

    // PuSH Pin
    var tocWrapper = $('.toc-wrapper');
    var mainContainer = $('.main-container');
    if (tocWrapper.length && mainContainer.length) {
        tocWrapper.pushpin({
            top: $('.main-container').offset().top
        });
    }
    // DASH CARD HANDLERS
    $('.card-dash .card-reveal .card-title').on("click", function () {
        return $(_this).closest('.card').removeAttr("style");
    });

    $('.card-dash .activator').on("click", function () {
        return $(_this).closest('.card').removeAttr("style");
    });

    // WINDOW ON RESIZE
    $(window).on('resize', function () {
        $('ul.tabs').tabs();
    });
});
$(window).on('load', function () {
    // Load Tab Elements
    setTimeout(function () {
        $('ul.tabs').tabs();
    }, 300);

    // Application PreLoader & Loader
    // ############# HIDE PRELOADER AND ITS OVERLAY #################
    setTimeout(function () {
        $('.preloader-center').addClass('loaded');
    }, 1000);
    setTimeout(function () {
        $("#preloader").addClass('loaded');
        $("#loader-wrapper").addClass('loaded');
    }, 1010);

    // ############# HIDE PRELOADER AND ITS OVERLAY ENDs #################

    /**
     * Custom scrollbars
     */
    var navdefault = document.getElementById('nav-default');
    if (typeof navdefault != 'undefined' && navdefault != null) {
        Ps.initialize(navdefault);
    }

    var psNotificationList = document.getElementById('psNotificationList');
    if (typeof psNotificationList != 'undefined' && psNotificationList != null) {
        Ps.initialize(psNotificationList);
    }

    var psTabShortcut = document.getElementById('psTabShortcut');
    if (typeof psTabShortcut != 'undefined' && psTabShortcut != null) {
        Ps.initialize(psTabShortcut);
    }
    var psTabNotelist = document.getElementById('psTabNotelist');
    if (typeof psTabNotelist != 'undefined' && psTabNotelist != null) {
        Ps.initialize(psTabNotelist);
    }
    var psTopNavMmsgs = document.getElementById('psTopNavMmsgs');
    var psTopNavMmsgsWeb = document.getElementById('psTopNavMmsgsWeb');
    if (typeof psTopNavMmsgs != 'undefined' && psTopNavMmsgs != null) {
        Ps.initialize(psTopNavMmsgs);
    }
    if (typeof psTopNavMmsgsWeb != 'undefined' && psTopNavMmsgsWeb != null) {
        Ps.initialize(psTopNavMmsgsWeb);
    }
    $(document).on("click", "a.close-flash", function () {
        return $('div.alert-flash').fadeOut(300);
    });
});

/***/ })

/******/ });