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
/******/ 	return __webpack_require__(__webpack_require__.s = 87);
/******/ })
/************************************************************************/
/******/ ({

/***/ 87:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(88);


/***/ }),

/***/ 88:
/***/ (function(module, exports) {

/**
 * [readURL :Read image data]
 * @param  {[file]} input [description]
 * @return {[type]}       [description]
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image_upload_preview').removeClass('hide').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

(function () {
    var _this = this;

    // Picture change event on signup page
    $("#signup-pic").on("change", function () {
        return readURL(_this);
    });

    $("a.switchVisibility").on("click", function () {
        var $this = $(_this),
            ref = $this.data('ref');
        activeClass = $('div.' + ref);
        activeClass.removeClass('hide').addClass('animated flipInY').delay(3000).removeClass('flipOutY');
        activeClass.siblings('div.auth-wrap').addClass('animated flipOutY').delay(3000).addClass('hide').removeClass('flipInY');
    });

    /**
     * [Spinner on Login click]
     */
    $('.mm-btn').on("click", function () {
        var $this = $(_this);
        var preloader = $this.data('preloader') ? $this.data('preloader') : 'teal';
        var setText = $this.data('text') ? $this.data('text') : $this.text();
        var setIcon = $this.data('icon') ? $this.data('icon') : '';
        var iconPos = $this.data('iconPos') && setIcon != '' ? $this.data('iconPos') : 'right';
        var redirectionPoint = $this.data('redirection') ? $this.data('redirection') : '';
        $this.text('');
        var setHtml = '<div class="preloader-wrapper small active">\n\t\t\t\t<div class="spinner-layer spinner-' + preloader + '-only">\n\t\t\t\t\t<div class="circle-clipper left">\n\t\t\t\t\t\t<div class="circle"></div>\n\t\t\t\t\t</div><div class="gap-patch">\n\t\t\t\t\t\t<div class="circle"></div>\n\t\t\t\t\t</div><div class="circle-clipper right">\n\t\t\t\t\t\t<div class="circle"></div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>';
        $this.addClass('btn-floating white').html(setHtml);
        setTimeout(function () {
            if (setIcon != '') {
                var textCont = setText + ' <i class="material-icons white-text ' + iconPos + '">' + setIcon + '</i>';
                $this.removeClass('btn-floating white').empty().html(textCont);
            } else {
                $this.removeClass('btn-floating white').empty().text(setText);
            }
            if (redirectionPoint != '') {
                window.location.href = "./index.html";
            }
        }, 5000);
    });
})();

/***/ })

/******/ });