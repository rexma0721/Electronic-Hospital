let verticalDefaultWidth = '240px';
let verticalIconizedWidth = '50px';
class Forge {
    constructor(navType, navOpt) {
        this.config = {
            navType,
            navOpt
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
    init() {
        // CALL OF SETTINGS
        this.settings();
        $(window).on('resize', () => this.windowResize());
        // DROP DOWN MENU (SIDEBAR ACCORDIAN : EXPANSTION)
        $(".full-top-nav .dropdown-button").on("click", () => {
            this.themeSettingSection.addClass('inactive').removeClass('active');
            this.rightNotificationBtn.addClass('menu').removeClass('rightArrow');
            this.notificationSection.removeClass('open-right-panel');
            return false;
        });
        // SEARCH OPEN
        this.appSearchBtn.on("click", () => { this.openSearch(); return false; });
        // SEARCH CLOSE
        this.appSearchClose.on("click", () => { this.closeSearch(); return false; });
        //  TOGGLING THEME SETTINGS
        this.toggleThemesetting.on("click", () => { this.toggleSettings(); return false; });
        // NOTIFICATION : RIGHT SIDEBAR
        this.rightNotificationBtn.on("click", (event) => { this.toggleRightNotification(event); return false; });

        /**
         * VERTICAL NAV EVENTS
         */
        this.verticalNavs.find('.collapsible-header').on("click", (event) => { this.verticlNavHeader(event); });
        this.verticalNavs.find('.collapsible-header').on("mouseenter", (event) => { this.verticalIconizedNavHead(event); });
        $(document).on('mouseleave', '#outter-sidebar', (event) => { this.resetOutter(); return false; });
        $(document).on('click', '#outter-sidebar .collapsible-header', (event) => { this.asideMenuCollapseHandler(event); });

        /**
         * TOP NAV MOBILE BUTTON EVENT
         */
        this.topNav.find('a.mob-menu').on("click", (event) => { this.topNavMobHandler(event); return false; });

        /**
         * HORIZONTAL NAV EVENTs
         */
        this.horizontalNavSelector.find('a.open_hor_sub').on("mouseenter", (event) => this.openhorizontalNavSubEnter(event))
            .on("mouseleave", (event) => this.openhorizontalNavSubLeave(event));
        this.horizontalNavSelector.find("div.hor_sub").on("mouseenter", (event) => {
            let $this = $(event.currentTarget);
            $this.show().removeClass('hide');
        }).on("mouseleave", (event) => {
            let $this = $(event.currentTarget);
            $this.hide().addClass('hide');
        });
        /**
         * OTHER NAV/Click events
         */
        this.iconizedToggle.on("click", (event) => { this.iconizedToggleHandler(event); });
        this.themeSettingSection.find('input:radio').on("click", (event) => { this.updateSetting(event); });
        this.navHiddenMenuToggle.on("click", (event) => { this.navHiddenMenuCallback(event); });
    }

    settings() {
        let conf = this.config;
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
    loadUserConfig() { // Loading User config setting
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
    loadStoredSetting() { // Loading store config setting
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
    openSearch(e) {
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
    closeSearch() {
        this.appSearchBar.toggleClass('active inactive');
        this.appSearchBar.find('input').val("");
    }

    /**
     * [toggleSettings : Show setting to choose menu]
     * @return {[type]} [description]
     */
    toggleSettings() {
        let settingSection = this.themeSettingSection;
        if (settingSection.hasClass('active') === false && settingSection.hasClass('inactive') === false) {
            settingSection.addClass('active');
        } else {
            settingSection.toggleClass('active inactive');
        }
    }

    /**
     * [iconizedToggleHandler  : -> toggle nav type handle among iconized/standard default menu]
     */
    iconizedToggleHandler(event) {
        if (localStorage.navOpt == 'iconized')
            this.navSetter({ navOpt: 'default' });
        else
            this.navSetter({ navOpt: 'iconized' });
    }

    /**
     * [toggleRightNotification : Show/hide right Notification]
     */
    toggleRightNotification(event) {
        $(event.currentTarget).toggleClass('menu rightArrow');
        this.notificationSection.toggleClass('open-right-panel');
        this.themeSettingSection.addClass('inactive').removeClass('active');
    }

    /**
     * [verticlNavHeader : Vertical Nav Header event]
     */
    verticlNavHeader(event) {
        let $this = $(event.currentTarget);
        let myPosition = $this.position();
        let scrollH = $this.prop('scrollHeight');
        if ($this.parents().eq(2).hasClass('icon-menu')) {
            // console.log('Yeah, I know');
            event.preventDefault();
            let collaposibleBody = $this.next('.collapsible-body').html();
            this.iconMenuFullAside($this, collaposibleBody, myPosition, scrollH);
            return false;
        } else {
            if ($this.hasClass('active')) {
                $this.children('i.mdi-navigation-chevron-left')
                    .addClass('close-aside').removeClass('open-aside');
            } else {
                $this.children('i.mdi-navigation-chevron-left')
                    .addClass('open-aside').removeClass('close-aside');
            }
            $this.closest('li').siblings('li')
                .children('a.collapsible-header').children('i.mdi-navigation-chevron-left')
                .addClass('close-aside').removeClass('open-aside');
        }
        // return false;
    }

    /**
     * [asideMenuCollapseHandler : Is menu open/close icon indicator]
     */
    asideMenuCollapseHandler(event) {
        var $this = $(event.currentTarget);
        if ($this.hasClass('active')) {
            $this.children('i.mdi-navigation-chevron-left')
                .addClass('open-aside').removeClass('close-aside');
        } else {
            $this.children('i.mdi-navigation-chevron-left')
                .addClass('close-aside').removeClass('open-aside');
        }
    }
    resetIconizeWidth(w) {
        /*this.verticalIconizedNav.css({
        	"width":w
        });
        this.verticalIconizedNav.children('li.menu-item').css({
        	"width":w
        });*/
    }

    /**
     * [resetOutter : reset outter sidebar (Verical Iconized menu)]
     */
    resetOutter() {
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
    iconMenuFullAside(obj, content = '', myPosition = 0, scrollheight = 0) {
        this.resetOutter();
        let setTop = myPosition.top;
        // console.log('top:'+myPosition.top, '---bottom:'+myPosition.bottom, "---h:"+scrollheight);
        // console.log("sum"+setTop);
        let htmlContent = this.sideHtmlBuilder(obj, content, setTop)
        this.verticalNavs.append(htmlContent);
        let unorderList = $('#outter-sidebar').children('.aside-content').children('ul');
        if (unorderList.length) {
            unorderList.addClass('sidescollable');
        }
        $('#outter-sidebar .collapsible').collapsible();
        let ele = document.getElementById("outter-sidebar").getElementsByClassName("sidescollable");
        if (ele.length) { Ps.initialize(ele[0]); }
    }

    /**
     * [sideHtmlBuilder : Vertical Icon menu builder for Outter div]
     * @param  {[type]} obj      [description]
     * @param  {[type]} content  [description]
     * @param  {[type]} leaveTop [description]
     * @return {[type]}          [description]
     */
    sideHtmlBuilder(obj, content, leaveTop) {
        let redirection = obj.attr('href');
        let arr = ["#", "!#", "#!", "javascript:void(0)"];
        let headlineText = obj.children('span').text();
        let htmlContent;
        if (content.length <= 0 && $.inArray(redirection, arr) == -1) {
            htmlContent = `
				<div class="aside-menu" id="outter-sidebar" style="top:${leaveTop+64}px">
					<a class="aside-headertext" href="${redirection}">${headlineText}</a>
				</div>
			`;
        } else {
            htmlContent = `
				<div class="aside-menu" id="outter-sidebar" style="top:${leaveTop+62}px">
					<span class="aside-headertext">${headlineText}</span>
					<div class='aside-content'>
						${content}
					</div>
				</div>
			`;
        }
        return htmlContent;
    }
    verticalIconizedNavHead(event) {
        if (this.verticalNavs.hasClass('icon-menu')) {
            this.verticlNavHeader(event);
        }
    }
    clickOnIconizedHead(event) {
        let $this = $(event.currentTarget);
        thisBody = $this.siblings('.iconized-collapsible-body');
        if (thisBody.length && thisBody.hasClass('iconized-body-enter')) {
            // this.verticalIconizedNav.animate({scrollTop:0},1000);
            thisBody.focus();
        }
    }

    verticalIconizedBody(event) {
        let $this = $(event.currentTarget);
        // Materialize.showStaggeredList($this);
        $this.addClass('iconized-body-leave')
            .removeClass('iconized-body-enter');
        this.resetIconizeWidth(50);
    }
    verticalIconizeMouserEnter(event) {
        let $this = $(event.currentTarget),
            thisHead = $this.children('a'),
            thisBody = $this.children('.iconized-collapsible-body');
        if ($this.hasClass('menu-item') && thisHead.hasClass('iconized-collapsible-head') == false) {
            this.resetIconizeWidth(50);
        }
        thisBody.addClass('iconized-body-enter')
            .removeClass('iconized-body-leave');
    }
    verticalIconizeMouserLeave(event) {
        let $this = $(event.currentTarget),
            thisHead = $this.children('a'),
            thisBody = $this.children('.iconized-collapsible-body');
        if (!thisBody.hasClass(":hover")) {
            thisBody.addClass('iconized-body-leave')
                .removeClass('iconized-body-enter');
            if ($this.hasClass('menu-item')) {
                this.resetIconizeWidth(50);
            }
        }
    }
    topNavMobHandler(event) {
        let $this = $(event.currentTarget),
            pointAttr = $this.attr('data-activates');
        // console.log(pointAttr);
    }
    openhorizontalNavSubEnter(event) {
        let $this = $(event.currentTarget);
        let hor_sub = $this.next('div.hor_sub');
        hor_sub.show().removeClass('hide');
    }
    openhorizontalNavSubLeave(event) {
        let $this = $(event.currentTarget);
        let hor_sub = $this.next('div.hor_sub');
        hor_sub.hide();
    }

    /**
     * [navSetter : Navigation setter]
     *  This will help to manage menu type (menu type-verical/horizontal and menu kind- icon/default)
     */
    navSetter(args) {
        let tnLeftUl = this.iconizedToggle.closest('ul.topnav-Menu-ls');
        let navType = (args.navType === undefined) ? localStorage.navType : args.navType; /*setting nav-type : Horizontal/vertical*/
        let navOpt = (args.navOpt === undefined) ? localStorage.navOpt : args.navOpt; /*setting nav-opt : default/iconized*/

        this.themeSettingSection.find('input[type=radio]').prop('checked', false); // Unset default/cached checked radio buttons
        this.subOptions(navType, navOpt);
        this.menuSwitch(navType, navOpt);
    }

    /**
     * [updateSetting : take update from user selected menu settings]
     */
    updateSetting(event) {
        let $this = $(event.currentTarget);
        let identfier = $this.attr('data-identfier');
        let selector = $this.attr('data-type');
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
    subOptions(navType, navOpt) {
        this.themeSettingSection.find(`[data-type="${navOpt}"]`).prop('checked', true); // Check radio button based on actual data
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
            this.navLogo.children('span').addClass('zoomIn').removeClass('zoomOut')
                .css({
                    'opacity': 1
                }).end()
                .removeClass('iconizedMenu-act').end();
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
            this.navLogo
                .children('span').addClass('zoomOut').removeClass('zoomIn')
                .css({
                    'opacity': 0
                }).end()
                .addClass('iconizedMenu-act');
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
    menuSwitch(navType, navOpt) {
        // MAIN MENU TYPE SELECTION
        this.themeSettingSection.find(`[data-type="${navType}"]`).prop('checked', true); // Check radio button based on actual data
        let vertImg = this.themeSettingSection.find('img.vert-set-svg');
        let horzImg = this.themeSettingSection.find('img.horz-set-svg');
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
                this.navLogo.children('span').addClass('zoomIn').removeClass('zoomOut')
                    .css({
                        'opacity': 1
                    }).end()
                    .removeClass('iconizedMenu-act').end();
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
    navHiddenMenuCallback(event) {
        let $this = $(event.currentTarget);
        let isHidden = this.navHiddenMenu.hasClass('hide');
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
    windowResize() {
        let win_width = $(window).width();
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
}

export default Forge;
