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
/******/ 	return __webpack_require__(__webpack_require__.s = 86);
/******/ })
/************************************************************************/
/******/ ({

/***/ 38:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var verticalDefaultWidth = '240px';
var verticalIconizedWidth = '50px';

var Forge = function () {
    function Forge(navType, navOpt) {
        _classCallCheck(this, Forge);

        this.config = {
            navType: navType,
            navOpt: navOpt
        };
        // console.log(this.config);
        this.header = $('header'); // Header
        this.main = $('main'); // Main content area
        // TOP NAVIGATION
        this.topNav = this.header.find('div.navbar-fixed'); // Top Navigation
        this.leftNavTop = this.topNav.find('ul.topnav-Menu-ls');
        this.appSearchBtn = this.topNav.find("a.app-search-btn");
        this.appSearchBar = this.topNav.find("form#app-search");
        this.appSearchClose = this.appSearchBar.find('i.app-search-Cls');
        // VERTICLE NAVIGATIONS
        this.verticalNavs = this.header.find('div.vertical-navigations'); // Wrapper of vertical nav
        this.verticalDefaultNav = this.verticalNavs.find('ul#nav-default'); // Default vertical nav
        this.activeNavigationHeader = $(document).find('ul.side-nav li.active');
        // this.verticalIconizedNav=this.verticalNavs.find('ul#nav-iconized'); // Iconized vertical nav

        // OTHER VERTICLE NAVIGATIONS
        this.verticalBars = this.header.find('div.other-verticalSections'); // Wrapper of other vertical nav
        this.notificationSection = this.verticalBars.find("div#sb-notification"); // Notification sidebar
        this.themeSettingSection = this.verticalBars.find("div#themeOptions"); // Theme setting sidebar

        // HORIZONTAL NAVS
        this.horizontalNavs = this.header.find('div.horizontal-navigations'); // Wrapper of Horizontal nav
        this.horizontalNavSelector = this.horizontalNavs.find('div.nav-wrapper ul');
        // BUTTONS
        this.toggleThemesetting = this.themeSettingSection.find('a.toggleThemesetting'); // open/close themeSetting sidebar
        this.rightNotificationBtn = this.topNav.find('a.notification-toggle-open'); // open/close notification sidebar
        this.navHiddenMenuToggle = this.topNav.find('a.toggle-topnav-hidden-menu');
        this.navHiddenMenu = this.topNav.find('.topnav-hidden-menu');
        this.defaultCollapse = this.topNav.find('a#sidebar-default-collapse'); // Mobile icon for collapse : default
        this.iconizedCollapse = this.topNav.find('a#sidebar-iconized-collapse'); // Mobile icon for collapse : iconized
        this.iconizedToggle = this.topNav.find('a.iconizedToggle'); // Toggle vertical : default and iconized
        this.navLogo = this.topNav.find('a.defaultMenu-logo');
    }

    /**
     * [init : Events]
     * @return {[type]} [description]
     */


    _createClass(Forge, [{
        key: 'init',
        value: function init() {
            var _this = this;

            // CALL OF SETTINGS
            this.settings();
            $(window).on('resize', function () {
                return _this.windowResize();
            });
            // DROP DOWN MENU (SIDEBAR ACCORDIAN : EXPANSTION)
            $(".full-top-nav .dropdown-button").on("click", function () {
                _this.themeSettingSection.addClass('inactive').removeClass('active');
                _this.rightNotificationBtn.addClass('menu').removeClass('rightArrow');
                _this.notificationSection.removeClass('open-right-panel');
                return false;
            });
            // SEARCH OPEN
            this.appSearchBtn.on("click", function () {
                _this.openSearch();return false;
            });
            // SEARCH CLOSE
            this.appSearchClose.on("click", function () {
                _this.closeSearch();return false;
            });
            //  TOGGLING THEME SETTINGS
            this.toggleThemesetting.on("click", function () {
                _this.toggleSettings();return false;
            });
            // NOTIFICATION : RIGHT SIDEBAR
            this.rightNotificationBtn.on("click", function (event) {
                _this.toggleRightNotification(event);return false;
            });

            /**
             * VERTICAL NAV EVENTS
             */
            this.verticalNavs.find('.collapsible-header').on("click", function (event) {
                _this.verticlNavHeader(event);
            });
            this.verticalNavs.find('.collapsible-header').on("mouseenter", function (event) {
                _this.verticalIconizedNavHead(event);
            });
            $(document).on('mouseleave', '#outter-sidebar', function (event) {
                _this.resetOutter();return false;
            });
            $(document).on('click', '#outter-sidebar .collapsible-header', function (event) {
                _this.asideMenuCollapseHandler(event);
            });

            /**
             * TOP NAV MOBILE BUTTON EVENT
             */
            this.topNav.find('a.mob-menu').on("click", function (event) {
                _this.topNavMobHandler(event);return false;
            });

            /**
             * HORIZONTAL NAV EVENTs
             */
            this.horizontalNavSelector.find('a.open_hor_sub').on("mouseenter", function (event) {
                return _this.openhorizontalNavSubEnter(event);
            }).on("mouseleave", function (event) {
                return _this.openhorizontalNavSubLeave(event);
            });
            this.horizontalNavSelector.find("div.hor_sub").on("mouseenter", function (event) {
                var $this = $(event.currentTarget);
                $this.show().removeClass('hide');
            }).on("mouseleave", function (event) {
                var $this = $(event.currentTarget);
                $this.hide().addClass('hide');
            });
            /**
             * OTHER NAV/Click events
             */
            this.iconizedToggle.on("click", function (event) {
                _this.iconizedToggleHandler(event);
            });
            this.themeSettingSection.find('input:radio').on("click", function (event) {
                _this.updateSetting(event);
            });
            this.navHiddenMenuToggle.on("click", function (event) {
                _this.navHiddenMenuCallback(event);
            });
        }
    }, {
        key: 'settings',
        value: function settings() {
            var conf = this.config;
            // CHECK LOCAL HAS MENU SETTINGS
            if (localStorage.sess == 1) {
                // console.log('load session vals');
                this.loadStoredSetting(); // Loading store setting based on HTML5 stored data
            }
            // IF User has its setting then load that one
            else {
                    // console.log('load user vals');
                    this.loadUserConfig(); // Loading user's default/config setting based on HTML5 stored data
                }
        }

        /**
         * [loadUserConfig : User Menu setting]
         * @return {[type]} [description]
         */

    }, {
        key: 'loadUserConfig',
        value: function loadUserConfig() {
            // Loading User config setting
            localStorage.removeItem("sess"); // Removing storedata
            localStorage.navType = this.config.navType; // Getting data from user's config
            localStorage.navOpt = this.config.navOpt; // Getting data from user's config
            this.navSetter({
                navType: this.config.navType, // vertical/horizontal
                navOpt: this.config.navOpt // default/iconized
            });
        }

        /**
         * [loadStoredSetting : Default menu settings]
         * @return {[type]} [description]
         */

    }, {
        key: 'loadStoredSetting',
        value: function loadStoredSetting() {
            // Loading store config setting
            this.navSetter({
                navType: localStorage.navType, // vertical/horizontal
                navOpt: localStorage.navOpt // default/iconized
            });
        }

        /**
         * [openSearch]
         * @param  {[type]} e [description]
         * @return {[type]}   [description]
         */

    }, {
        key: 'openSearch',
        value: function openSearch(e) {
            if (this.appSearchBar.hasClass('active') === false && this.appSearchBar.hasClass('inactive') === false) {
                this.appSearchBar.addClass('active');
            } else {
                this.appSearchBar.toggleClass('active inactive');
                this.appSearchBar.find('input').val("");
            }
        }

        /**
         * [closeSearch close search]
         * @return {[type]} [description]
         */

    }, {
        key: 'closeSearch',
        value: function closeSearch() {
            this.appSearchBar.toggleClass('active inactive');
            this.appSearchBar.find('input').val("");
        }

        /**
         * [toggleSettings : Show setting to choose menu]
         * @return {[type]} [description]
         */

    }, {
        key: 'toggleSettings',
        value: function toggleSettings() {
            var settingSection = this.themeSettingSection;
            if (settingSection.hasClass('active') === false && settingSection.hasClass('inactive') === false) {
                settingSection.addClass('active');
            } else {
                settingSection.toggleClass('active inactive');
            }
        }

        /**
         * [iconizedToggleHandler  : -> toggle nav type handle among iconized/standard default menu]
         */

    }, {
        key: 'iconizedToggleHandler',
        value: function iconizedToggleHandler(event) {
            if (localStorage.navOpt == 'iconized') this.navSetter({ navOpt: 'default' });else this.navSetter({ navOpt: 'iconized' });
        }

        /**
         * [toggleRightNotification : Show/hide right Notification]
         */

    }, {
        key: 'toggleRightNotification',
        value: function toggleRightNotification(event) {
            $(event.currentTarget).toggleClass('menu rightArrow');
            this.notificationSection.toggleClass('open-right-panel');
            this.themeSettingSection.addClass('inactive').removeClass('active');
        }

        /**
         * [verticlNavHeader : Vertical Nav Header event]
         */

    }, {
        key: 'verticlNavHeader',
        value: function verticlNavHeader(event) {
            var $this = $(event.currentTarget);
            var myPosition = $this.position();
            var scrollH = $this.prop('scrollHeight');
            if ($this.parents().eq(2).hasClass('icon-menu')) {
                // console.log('Yeah, I know');
                event.preventDefault();
                var collaposibleBody = $this.next('.collapsible-body').html();
                this.iconMenuFullAside($this, collaposibleBody, myPosition, scrollH);
                return false;
            } else {
                if ($this.hasClass('active')) {
                    $this.children('i.mdi-navigation-chevron-left').addClass('close-aside').removeClass('open-aside');
                } else {
                    $this.children('i.mdi-navigation-chevron-left').addClass('open-aside').removeClass('close-aside');
                }
                $this.closest('li').siblings('li').children('a.collapsible-header').children('i.mdi-navigation-chevron-left').addClass('close-aside').removeClass('open-aside');
            }
            // return false;
        }

        /**
         * [asideMenuCollapseHandler : Is menu open/close icon indicator]
         */

    }, {
        key: 'asideMenuCollapseHandler',
        value: function asideMenuCollapseHandler(event) {
            var $this = $(event.currentTarget);
            if ($this.hasClass('active')) {
                $this.children('i.mdi-navigation-chevron-left').addClass('open-aside').removeClass('close-aside');
            } else {
                $this.children('i.mdi-navigation-chevron-left').addClass('close-aside').removeClass('open-aside');
            }
        }
    }, {
        key: 'resetIconizeWidth',
        value: function resetIconizeWidth(w) {}
        /*this.verticalIconizedNav.css({
        	"width":w
        });
        this.verticalIconizedNav.children('li.menu-item').css({
        	"width":w
        });*/


        /**
         * [resetOutter : reset outter sidebar (Verical Iconized menu)]
         */

    }, {
        key: 'resetOutter',
        value: function resetOutter() {
            $("#outter-sidebar").remove();
        }

        /**
         * [iconMenuFullAside : Icon menu handler]
         * @param  {[type]} obj          [description]
         * @param  {String} content      [description]
         * @param  {Number} myPosition   [description]
         * @param  {Number} scrollheight [description]
         * @return {[type]}              [description]
         */

    }, {
        key: 'iconMenuFullAside',
        value: function iconMenuFullAside(obj) {
            var content = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
            var myPosition = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
            var scrollheight = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;

            this.resetOutter();
            var setTop = myPosition.top;
            // console.log('top:'+myPosition.top, '---bottom:'+myPosition.bottom, "---h:"+scrollheight);
            // console.log("sum"+setTop);
            var htmlContent = this.sideHtmlBuilder(obj, content, setTop);
            this.verticalNavs.append(htmlContent);
            var unorderList = $('#outter-sidebar').children('.aside-content').children('ul');
            if (unorderList.length) {
                unorderList.addClass('sidescollable');
            }
            $('#outter-sidebar .collapsible').collapsible();
            var ele = document.getElementById("outter-sidebar").getElementsByClassName("sidescollable");
            if (ele.length) {
                Ps.initialize(ele[0]);
            }
        }

        /**
         * [sideHtmlBuilder : Vertical Icon menu builder for Outter div]
         * @param  {[type]} obj      [description]
         * @param  {[type]} content  [description]
         * @param  {[type]} leaveTop [description]
         * @return {[type]}          [description]
         */

    }, {
        key: 'sideHtmlBuilder',
        value: function sideHtmlBuilder(obj, content, leaveTop) {
            var redirection = obj.attr('href');
            var arr = ["#", "!#", "#!", "javascript:void(0)"];
            var headlineText = obj.children('span').text();
            var htmlContent = void 0;
            if (content.length <= 0 && $.inArray(redirection, arr) == -1) {
                htmlContent = '\n\t\t\t\t<div class="aside-menu" id="outter-sidebar" style="top:' + (leaveTop + 64) + 'px">\n\t\t\t\t\t<a class="aside-headertext" href="' + redirection + '">' + headlineText + '</a>\n\t\t\t\t</div>\n\t\t\t';
            } else {
                htmlContent = '\n\t\t\t\t<div class="aside-menu" id="outter-sidebar" style="top:' + (leaveTop + 62) + 'px">\n\t\t\t\t\t<span class="aside-headertext">' + headlineText + '</span>\n\t\t\t\t\t<div class=\'aside-content\'>\n\t\t\t\t\t\t' + content + '\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t';
            }
            return htmlContent;
        }
    }, {
        key: 'verticalIconizedNavHead',
        value: function verticalIconizedNavHead(event) {
            if (this.verticalNavs.hasClass('icon-menu')) {
                this.verticlNavHeader(event);
            }
        }
    }, {
        key: 'clickOnIconizedHead',
        value: function clickOnIconizedHead(event) {
            var $this = $(event.currentTarget);
            thisBody = $this.siblings('.iconized-collapsible-body');
            if (thisBody.length && thisBody.hasClass('iconized-body-enter')) {
                // this.verticalIconizedNav.animate({scrollTop:0},1000);
                thisBody.focus();
            }
        }
    }, {
        key: 'verticalIconizedBody',
        value: function verticalIconizedBody(event) {
            var $this = $(event.currentTarget);
            // Materialize.showStaggeredList($this);
            $this.addClass('iconized-body-leave').removeClass('iconized-body-enter');
            this.resetIconizeWidth(50);
        }
    }, {
        key: 'verticalIconizeMouserEnter',
        value: function verticalIconizeMouserEnter(event) {
            var $this = $(event.currentTarget),
                thisHead = $this.children('a'),
                thisBody = $this.children('.iconized-collapsible-body');
            if ($this.hasClass('menu-item') && thisHead.hasClass('iconized-collapsible-head') == false) {
                this.resetIconizeWidth(50);
            }
            thisBody.addClass('iconized-body-enter').removeClass('iconized-body-leave');
        }
    }, {
        key: 'verticalIconizeMouserLeave',
        value: function verticalIconizeMouserLeave(event) {
            var $this = $(event.currentTarget),
                thisHead = $this.children('a'),
                thisBody = $this.children('.iconized-collapsible-body');
            if (!thisBody.hasClass(":hover")) {
                thisBody.addClass('iconized-body-leave').removeClass('iconized-body-enter');
                if ($this.hasClass('menu-item')) {
                    this.resetIconizeWidth(50);
                }
            }
        }
    }, {
        key: 'topNavMobHandler',
        value: function topNavMobHandler(event) {
            var $this = $(event.currentTarget),
                pointAttr = $this.attr('data-activates');
            // console.log(pointAttr);
        }
    }, {
        key: 'openhorizontalNavSubEnter',
        value: function openhorizontalNavSubEnter(event) {
            var $this = $(event.currentTarget);
            var hor_sub = $this.next('div.hor_sub');
            hor_sub.show().removeClass('hide');
        }
    }, {
        key: 'openhorizontalNavSubLeave',
        value: function openhorizontalNavSubLeave(event) {
            var $this = $(event.currentTarget);
            var hor_sub = $this.next('div.hor_sub');
            hor_sub.hide();
        }

        /**
         * [navSetter : Navigation setter]
         *  This will help to manage menu type (menu type-verical/horizontal and menu kind- icon/default)
         */

    }, {
        key: 'navSetter',
        value: function navSetter(args) {
            var tnLeftUl = this.iconizedToggle.closest('ul.topnav-Menu-ls');
            var navType = args.navType === undefined ? localStorage.navType : args.navType; /*setting nav-type : Horizontal/vertical*/
            var navOpt = args.navOpt === undefined ? localStorage.navOpt : args.navOpt; /*setting nav-opt : default/iconized*/

            this.themeSettingSection.find('input[type=radio]').prop('checked', false); // Unset default/cached checked radio buttons
            this.subOptions(navType, navOpt);
            this.menuSwitch(navType, navOpt);
        }

        /**
         * [updateSetting : take update from user selected menu settings]
         */

    }, {
        key: 'updateSetting',
        value: function updateSetting(event) {
            var $this = $(event.currentTarget);
            var identfier = $this.attr('data-identfier');
            var selector = $this.attr('data-type');
            localStorage.sess = 1; // Setting sess variable
            switch (identfier) {
                case 'theme_nav':
                    this.navSetter({ navType: selector });
                    break;
                case 'theme_nav_opts':
                    this.navSetter({ navOpt: selector });
                    break;
            }
            return false;
        }

        /**
         * [subOptions : Menu kind options manager]
         * @param  {[type]} navType [description]
         * @param  {[type]} navOpt  [description]
         * @return {[type]}         [description]
         */

    }, {
        key: 'subOptions',
        value: function subOptions(navType, navOpt) {
            this.themeSettingSection.find('[data-type="' + navOpt + '"]').prop('checked', true); // Check radio button based on actual data
            if (navType == 'vertical' && navOpt == 'default') {
                // Actived when req for vertical and default
                localStorage.navOpt = 'default';
                // console.log('vertical default');
                // self.verticalDefaultNav.removeClass('hide-on-large-only');
                // LOGIC of  vertical default
                this.defaultCollapse.show().siblings('a.button-collapse').hide(); // collapse button
                this.verticalNavs.removeClass('icon-menu'); // Show Default Sidemenu
                this.resetOutter(); // Reset aside-menu-box
                // the last active menu.
                this.verticalNavs.find('ul.side-nav  > li.active').children('.collapsible-body').show();
                this.verticalNavs.find('ul.side-nav  > li.active').children('.collapsible-body').removeClass('hide-iconized');
                // Transition effect
                this.main.addClass('transition-main-enter').removeClass('transition-main-horizontalAct transition-main-enter2'); // Set main width
                this.navLogo.children('span').addClass('zoomIn').removeClass('zoomOut').css({
                    'opacity': 1
                }).end().removeClass('iconizedMenu-act').end();
                this.navLogo.children('.logo-icon').removeClass('iconized');
                this.leftNavTop.addClass('move-right').removeClass('move-left');
                // .css('left',"0px");
                this.iconizedToggle.addClass('leftArrow').removeClass('rightArrow');
            } else if (navType == 'vertical' && navOpt == 'iconized') {
                // Actived when req for vertical and iconized
                localStorage.navOpt = 'iconized';
                // console.log('vertical iconized');
                this.navLogo.children('.logo-icon').addClass('iconized');
                // self.verticalDefaultNav.removeClass('hide-on-large-only');
                // LOGIC of  vertical default
                // this.iconizedCollapse.show().siblings('a.button-collapse').hide(); // collapse button
                this.verticalNavs.addClass('icon-menu'); // ENABLE ICON MENU
                this.verticalNavs.children('ul.side-nav').find('li a.collapsible-header').next('.collapsible-body').addClass('hide-iconized');
                this.verticalNavs.children('ul.side-nav').find('li a.collapsible-header').next('.collapsible-body').hide();
                this.main.addClass('transition-main-enter2').removeClass('transition-main-horizontalAct transition-main-enter'); // Set main width
                this.navLogo.children('span').addClass('zoomOut').removeClass('zoomIn').css({
                    'opacity': 0
                }).end().addClass('iconizedMenu-act');
                this.navLogo.children('img').css({
                    'padding-left': '0px'
                });
                this.leftNavTop.addClass('move-left').removeClass('move-right');
                // .css('left',this.verticalIconizedWidth);
                this.iconizedToggle.addClass('rightArrow').removeClass('leftArrow');
            }

            if (navType == 'horizontal' && navOpt == 'default') {
                // Actived when req for vertical and default
                localStorage.navOpt = 'default';
                // console.log('horizontal default');
                // self.verticalDefaultNav.removeClass('hide-on-large-only');
                // LOGIC of  vertical default
                this.defaultCollapse.show().siblings('a.button-collapse').hide(); // collapse button
                this.horizontalNavSelector.addClass('default').removeClass('iconized');
            } else if (navType == 'horizontal' && navOpt == 'iconized') {
                // Actived when req for vertical and iconized
                localStorage.navOpt = 'iconized';
                // console.log('horizontal iconized');
                // this.verticalDefaultNav.removeClass('hide-on-large-only');
                // LOGIC of  vertical default
                this.iconizedCollapse.show().siblings('a.button-collapse').hide(); // collapse button
                this.horizontalNavSelector.addClass('iconized').removeClass('default');
            }
        }

        /**
         * [menuSwitch : Menu switcher]
         * @param  {[type]} navType [description]
         * @param  {[type]} navOpt  [description]
         * @return {[type]}         [description]
         */

    }, {
        key: 'menuSwitch',
        value: function menuSwitch(navType, navOpt) {
            // MAIN MENU TYPE SELECTION
            this.themeSettingSection.find('[data-type="' + navType + '"]').prop('checked', true); // Check radio button based on actual data
            var vertImg = this.themeSettingSection.find('img.vert-set-svg');
            var horzImg = this.themeSettingSection.find('img.horz-set-svg');
            switch (navType) {
                case 'horizontal':
                    localStorage.navType = navType;
                    // console.log('Inside navSetter and switched to horizontal');
                    horzImg.show();
                    vertImg.hide();

                    this.main.addClass('transition-main-horizontalAct').removeClass('transition-main-enter transition-main-enter2');
                    this.horizontalNavs.addClass('show').removeClass('hide');
                    this.verticalNavs.addClass('hide hide-on-large-only').removeClass('show');
                    this.iconizedToggle.addClass('hide-on-large-only');
                    this.navLogo.children('span').addClass('zoomIn').removeClass('zoomOut').css({
                        'opacity': 1
                    }).end().removeClass('iconizedMenu-act').end();
                    this.navLogo.children('img').css({
                        'padding-left': '30px'
                    });
                    this.leftNavTop.addClass('move-right').removeClass('move-left');
                    // this.subOptions();
                    break;
                default:
                    localStorage.navType = navType;
                    vertImg.show();
                    horzImg.hide();
                    this.horizontalNavs.addClass('hide').removeClass('show');
                    this.verticalNavs.addClass('show').removeClass('hide hide-on-large-only');
                    this.iconizedToggle.removeClass('hide-on-large-only');
                    // console.log('Inside navSetter and switched to vertical');
                    // this.subOptions();
                    break;
            }
        }
    }, {
        key: 'navHiddenMenuCallback',
        value: function navHiddenMenuCallback(event) {
            var $this = $(event.currentTarget);
            var isHidden = this.navHiddenMenu.hasClass('hide');
            if (isHidden) {
                this.navHiddenMenu.removeClass('hide').addClass('show');
                return false;
            }
            this.navHiddenMenu.addClass('hide').removeClass('show');
            return false;
        }

        /**
         * [windowResize : Trace on window resize - change menu type for mobile devices]
         * @return {[type]} [description]
         */

    }, {
        key: 'windowResize',
        value: function windowResize() {
            var win_width = $(window).width();
            // this.verticalIconizedNavHeight=this.verticalIconizedNav.prop('scrollHeight');
            if (win_width < 992 && localStorage.navType == 'horizontal') {
                localStorage.tempNav = 1;
                this.navSetter({ navType: 'vertical' });
                // console.log('width is less than 992 and type is horizontal');
            } else if (win_width > 992 && localStorage.tempNav == 1) {
                localStorage.tempNav = 0;
                this.navSetter({ navType: 'horizontal' });
                // console.log('width is greater than 992 and type is horizontal');
            }
        }
    }]);

    return Forge;
}();

/* harmony default export */ __webpack_exports__["default"] = (Forge);

/***/ }),

/***/ 86:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(38);


/***/ })

/******/ });