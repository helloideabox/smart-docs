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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/settings/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArrayLimit(arr, i) {
  if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return;
  var _arr = [];
  var _n = true;
  var _d = false;
  var _e = undefined;

  try {
    for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

module.exports = _iterableToArrayLimit;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableRest;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles */ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js");

var iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit */ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableRest = __webpack_require__(/*! ./nonIterableRest */ "./node_modules/@babel/runtime/helpers/nonIterableRest.js");

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;

/***/ }),

/***/ "./src/settings/Header.js":
/*!********************************!*\
  !*** ./src/settings/Header.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Header; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress Dependencies
 */


function Header() {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    id: "sd-setting-header",
    class: " mx-auto flex justify-center justify-items-center p-10 mb-8 shadow bg-white "
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("h2", {
    class: "text-5xl"
  }, "Smart Docs"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("sup", {
    class: "text-sm text-gray-500"
  }, "v ", sd_vars.version)));
}

/***/ }),

/***/ "./src/settings/SidePanel.js":
/*!***********************************!*\
  !*** ./src/settings/SidePanel.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SidePanel; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);


function SidePanel() {
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["Card"], {
    isElevated: "true",
    className: "smart-docs-side-card col-span-1 m-5 h-fit-content"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["CardHeader"], {
    className: "smart-docs-card-header font-bold text-xl pl-5 pt-4 pb-3"
  }, "Help/Support"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["CardBody"], null, "Found a issue? or Have a suggestion? ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), "We use Github to track issues and suggestions. Click the link below to go to our Github Page and post issue/suggestion."), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["CardFooter"], {
    className: "smart-docs-card-footer pt-4 pb-4"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["ExternalLink"], {
    className: "w-full inline-flex font-medium text-base",
    href: "https://github.com/helloideabox/smart-docs/issues"
  }, "Raise a Ticket")));
}

/***/ }),

/***/ "./src/settings/Tabs.js":
/*!******************************!*\
  !*** ./src/settings/Tabs.js ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Tabs; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _tabs_General__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./tabs/General */ "./src/settings/tabs/General.js");
/* harmony import */ var _tabs_Layout__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./tabs/Layout */ "./src/settings/tabs/Layout.js");
/* harmony import */ var _tabs_Search__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./tabs/Search */ "./src/settings/tabs/Search.js");






function Tabs() {
  var tabClasses = "sd-setting-primary-tab px-4 text-base duration-200";
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["TabPanel"], {
    className: "sd-settings-tabs m-5 col-span-2 row-span-2 bg-white",
    activeClass: "is-active",
    tabs: [{
      name: "general",
      title: "General",
      className: tabClasses
    }, {
      name: "layout",
      title: "Layout",
      className: tabClasses
    }, {
      name: "search",
      title: "Search",
      className: tabClasses
    }]
  }, function (tab) {
    if ("general" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_General__WEBPACK_IMPORTED_MODULE_2__["default"], null);
    } else if ("layout" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_Layout__WEBPACK_IMPORTED_MODULE_3__["default"], null);
    } else if ("search" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_tabs_Search__WEBPACK_IMPORTED_MODULE_4__["default"], null);
    }
  });
}

/***/ }),

/***/ "./src/settings/index.js":
/*!*******************************!*\
  !*** ./src/settings/index.js ***!
  \*******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _index_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.scss */ "./src/settings/index.scss");
/* harmony import */ var _index_scss__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_index_scss__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _Header__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Header */ "./src/settings/Header.js");
/* harmony import */ var _Tabs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Tabs */ "./src/settings/Tabs.js");
/* harmony import */ var _SidePanel__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./SidePanel */ "./src/settings/SidePanel.js");
/* harmony import */ var _notices_notices__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./notices/notices */ "./src/settings/notices/notices.js");







var loader = document.querySelector(".loader"); // if you want to show the loader when React loads data again

var showLoader = function showLoader() {
  return loader.classList.remove("loader--hide");
};

var hideLoader = function hideLoader() {
  return loader.classList.add("loader--hide");
};

var App = function App(_ref) {
  var hideLoader = _ref.hideLoader;
  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["useEffect"])(hideLoader, []);
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_Header__WEBPACK_IMPORTED_MODULE_2__["default"], null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "grid grid-cols-3 grid-rows-2 container mx-auto"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_Tabs__WEBPACK_IMPORTED_MODULE_3__["default"], null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_SidePanel__WEBPACK_IMPORTED_MODULE_4__["default"], null)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_notices_notices__WEBPACK_IMPORTED_MODULE_5__["default"], null));
};
/**
 * WordPress Dependencies
 */



setTimeout(function () {
  Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["render"])(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(App, {
    hideLoader: hideLoader,
    showLoader: showLoader
  }), document.getElementById("sd-setting-root"));
}, 0);

/***/ }),

/***/ "./src/settings/index.scss":
/*!*********************************!*\
  !*** ./src/settings/index.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./src/settings/notices/notices.js":
/*!*****************************************!*\
  !*** ./src/settings/notices/notices.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SettingsNotices; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);


/**
 * External dependencies
 */

/**
 * WordPress dependencies
 */



function SettingsNotices() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__["useDispatch"])('core/notices'),
      removeNotice = _useDispatch.removeNotice;

  var notices = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__["useSelect"])(function (select) {
    return select('core/notices').getNotices();
  }, []);
  var dismissibleNotices = Object(lodash__WEBPACK_IMPORTED_MODULE_1__["filter"])(notices, {
    isDismissible: true,
    type: 'default'
  });
  var nonDismissibleNotices = Object(lodash__WEBPACK_IMPORTED_MODULE_1__["filter"])(notices, {
    isDismissible: false,
    type: 'default'
  });
  var snackbarNotices = Object(lodash__WEBPACK_IMPORTED_MODULE_1__["filter"])(notices, {
    type: 'snackbar'
  });
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["NoticeList"], {
    notices: nonDismissibleNotices,
    className: "components-notice-list components-editor-notices__pinned"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["NoticeList"], {
    notices: dismissibleNotices,
    className: "components-notice-list components-editor-notices__dismissible",
    onRemove: removeNotice
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["SnackbarList"], {
    notices: snackbarNotices,
    className: "components-snackbar-list components-editor-notices__snackbar",
    onRemove: removeNotice
  }));
}

/***/ }),

/***/ "./src/settings/tabs/ArchivePage.js":
/*!******************************************!*\
  !*** ./src/settings/tabs/ArchivePage.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return DocPage; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);







function DocPage() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__["useDispatch"])("core/notices"),
      createSuccessNotice = _useDispatch.createSuccessNotice,
      createErrorNotice = _useDispatch.createErrorNotice;
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */


  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_archive_sidebar"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      showSidebar = _useEntityProp2[0],
      setShowSidebar = _useEntityProp2[1];

  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_archive_layout"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      layout = _useEntityProp4[0],
      setLayout = _useEntityProp4[1];

  var _useEntityProp5 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_archive_search"),
      _useEntityProp6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp5, 2),
      showSearch = _useEntityProp6[0],
      setShowSearch = _useEntityProp6[1];

  var _useEntityProp7 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_archive_suggested"),
      _useEntityProp8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp7, 2),
      showSuggestedArticles = _useEntityProp8[0],
      setShowSuggestedArticles = _useEntityProp8[1];

  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      saving = _useState2[0],
      setSaving = _useState2[1];

  function handleSaveSettings() {
    setSaving(true);
    var status = wp.data.dispatch("core").saveSite({
      ibx_sd_archive_sidebar: showSidebar,
      ibx_sd_archive_layout: layout,
      ibx_sd_archive_search: showSearch,
      ibx_sd_archive_suggested: showSuggestedArticles
    }).then(function () {
      createSuccessNotice("Settings Saved!", {
        type: "snackbar"
      });
    }).catch(function (e) {
      createErrorNotice("There was some error saving settings! \nCheck console for more information on error.", {
        type: "snackbar"
      });
      console.log(e);
    });
    setSaving(false);
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    label: "Archive Page Layout"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadioGroup"], {
    id: "sd_option-doc-archive-layout",
    className: "ml-5",
    label: "Documentation Archive Page Layout",
    checked: layout,
    onChange: setLayout
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadio"], {
    value: "list"
  }, "List"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadio"], {
    value: "grid"
  }, "Grid"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Sidebar",
    checked: showSidebar,
    onChange: setShowSidebar
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Search Bar",
    checked: showSearch,
    onChange: setShowSearch
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Suggested Articles",
    checked: showSuggestedArticles,
    onChange: setShowSuggestedArticles
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    className: "mt-6 mb-3",
    isPrimary: "true",
    isBusy: saving,
    onClick: handleSaveSettings
  }, "Save Changes"));
}

/***/ }),

/***/ "./src/settings/tabs/DocPage.js":
/*!**************************************!*\
  !*** ./src/settings/tabs/DocPage.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return DocPage; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _sections_layout_ListLayoutSettings__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./sections/layout/ListLayoutSettings */ "./src/settings/tabs/sections/layout/ListLayoutSettings.js");
/* harmony import */ var _sections_layout_GridLayoutSettings__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./sections/layout/GridLayoutSettings */ "./src/settings/tabs/sections/layout/GridLayoutSettings.js");








function DocPage() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_4__["useDispatch"])("core/notices"),
      createSuccessNotice = _useDispatch.createSuccessNotice,
      createErrorNotice = _useDispatch.createErrorNotice;
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */

  /**
   * Documentation Page Layout Key
   */


  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_layout"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      layout = _useEntityProp2[0],
      setLayout = _useEntityProp2[1];
  /**
   * Show number of docs count.
   *
   * @type boolean
   */


  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_count"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      docsCount = _useEntityProp4[0],
      setDocsCount = _useEntityProp4[1];
  /**
   * Show Authors.
   *
   * @type boolean
   */


  var _useEntityProp5 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_authors"),
      _useEntityProp6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp5, 2),
      showAuthors = _useEntityProp6[0],
      setShowAuthors = _useEntityProp6[1];
  /**
   * Show number of docs count.
   *
   * @type boolean
   */


  var _useEntityProp7 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_search"),
      _useEntityProp8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp7, 2),
      showSearch = _useEntityProp8[0],
      setShowSearch = _useEntityProp8[1];
  /**
   * Button Saving state
   *
   * @since 1.0.0
   */


  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      saving = _useState2[0],
      setSaving = _useState2[1];
  /**
   * Fetching settings for List and Grid layout
   */


  var _useEntityProp9 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_list_layout_icon"),
      _useEntityProp10 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp9, 1),
      showIcon = _useEntityProp10[0];

  var _useEntityProp11 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_list_layout_columns"),
      _useEntityProp12 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp11, 1),
      listColumns = _useEntityProp12[0];

  var _useEntityProp13 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_grid_layout_icon"),
      _useEntityProp14 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp13, 1),
      gridShowIcon = _useEntityProp14[0];

  var _useEntityProp15 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_doc_page_grid_layout_columns"),
      _useEntityProp16 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp15, 1),
      gridColumns = _useEntityProp16[0];
  /**
   * Save settings.
   *
   * Save settings to the WordPress Database.
   *
   * @since 1.0.0
   */


  function handleSaveSettings() {
    setSaving(true);
    var settings = {
      ibx_sd_doc_page_layout: layout,
      ibx_sd_doc_page_authors: showAuthors,
      ibx_sd_doc_page_search: showSearch,
      ibx_sd_doc_page_count: docsCount,
      ibx_sd_doc_page_list_layout_icon: showIcon,
      ibx_sd_doc_page_list_layout_columns: listColumns,
      ibx_sd_doc_page_grid_layout_icon: gridShowIcon,
      ibx_sd_doc_page_grid_layout_columns: gridColumns
    };
    var status = wp.data.dispatch("core").saveSite(settings).then(function () {
      createSuccessNotice("Settings Saved!", {
        type: "snackbar"
      });
    }).catch(function (e) {
      createErrorNotice("There was some error saving settings! \nCheck console for more information on error.", {
        type: "snackbar"
      });
      console.log(e);
    });
    setSaving(false);
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    label: "Documentation Page Layout"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadioGroup"], {
    id: "sd_option-doc-homepage-layout",
    className: "ml-5",
    label: "Documentation Page Layout",
    checked: layout,
    onChange: setLayout
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadio"], {
    value: "list"
  }, "List"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalRadio"], {
    value: "grid"
  }, "Grid"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Docs Count",
    checked: docsCount,
    onChange: setDocsCount
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Docs Authors",
    checked: showAuthors,
    onChange: setShowAuthors
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Docs Authors",
    checked: showSearch,
    onChange: setShowSearch
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", null, "list" === layout ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_sections_layout_ListLayoutSettings__WEBPACK_IMPORTED_MODULE_5__["default"], null) : null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", null, "grid" === layout ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_sections_layout_GridLayoutSettings__WEBPACK_IMPORTED_MODULE_6__["default"], null) : null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    className: "mt-6 mb-3",
    isPrimary: "true",
    isBusy: saving,
    onClick: handleSaveSettings
  }, "Save Changes"));
}

/***/ }),

/***/ "./src/settings/tabs/General.js":
/*!**************************************!*\
  !*** ./src/settings/tabs/General.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return General; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);







function General() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__["useDispatch"])("core/notices"),
      createSuccessNotice = _useDispatch.createSuccessNotice,
      createErrorNotice = _useDispatch.createErrorNotice;
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */


  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "sd_archive_page_title"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      title = _useEntityProp2[0],
      setTitle = _useEntityProp2[1];

  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "sd_archive_page_slug"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      titleSlug = _useEntityProp4[0],
      setTitleSlug = _useEntityProp4[1];

  var _useEntityProp5 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "sd_category_slug"),
      _useEntityProp6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp5, 2),
      categorySlug = _useEntityProp6[0],
      setCategorySlug = _useEntityProp6[1];

  var _useEntityProp7 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "sd_tag_slug"),
      _useEntityProp8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp7, 2),
      tagSlug = _useEntityProp8[0],
      setTagSlug = _useEntityProp8[1];
  /**
   * Button Saving state
   *
   * @since 1.0.0
   */


  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      saving = _useState2[0],
      setSaving = _useState2[1];

  function handleSaveSettings() {
    setSaving(true);
    var status = wp.data.dispatch("core").saveSite({
      sd_archive_page_title: title,
      sd_archive_page_slug: titleSlug,
      sd_category_slug: categorySlug,
      sd_tag_slug: tagSlug
    }).then(function () {
      createSuccessNotice("Settings Saved!", {
        type: "snackbar"
      });
    }).catch(function (e) {
      createErrorNotice("There was some error saving settings! \nCheck console for more information on error.", {
        type: "snackbar"
      });
      console.log(e);
    });
    setSaving(false);
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    id: "textarea-1",
    label: "Documentation Page Title",
    help: "Edit to change the default title for the documentation page.",
    className: "mb-3"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    id: "sd_option-doc_homepage_title",
    className: "mt-2 block mb-2",
    value: title,
    placeholder: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])("Documentation"),
    onChange: setTitle
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    id: "textarea-2",
    label: "Documentation Archive Slug",
    help: "Edit to change the default slug for the documentation page.",
    className: "mb-3"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    id: "sd_option-doc_homepage_slug",
    className: "mt-2 block mb-2",
    value: titleSlug,
    placeholder: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])("Add documentation archive/home page slug"),
    onChange: setTitleSlug
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    id: "textarea-3",
    label: "Documentation Category Slug",
    help: "Edit to change the default slug for the documentation category.",
    className: "mb-3"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    id: "sd_option-doc_category_slug",
    className: "mt-2 block mb-2",
    value: categorySlug,
    placeholder: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])("Add custom category slug"),
    onChange: setCategorySlug
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    id: "textarea-3",
    label: "Documentation Tag Slug",
    help: "Edit to change the default slug for the documentation tag."
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    id: "sd_option-doc_tag_slug",
    className: "mt-2 block mb-2",
    value: tagSlug,
    placeholder: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])("Add custom tag slug"),
    onChange: setTagSlug
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    className: "mt-6 mb-3",
    isPrimary: "true",
    isBusy: saving,
    onClick: handleSaveSettings
  }, "Save Changes"));
}

/***/ }),

/***/ "./src/settings/tabs/Layout.js":
/*!*************************************!*\
  !*** ./src/settings/tabs/Layout.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Layout; });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _DocPage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./DocPage */ "./src/settings/tabs/DocPage.js");
/* harmony import */ var _SinglePage__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./SinglePage */ "./src/settings/tabs/SinglePage.js");
/* harmony import */ var _ArchivePage__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./ArchivePage */ "./src/settings/tabs/ArchivePage.js");





function Layout() {
  var tabClasses = "py-3 px-4 text-sl duration-200";
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__["TabPanel"], {
    className: "sd-layout-settings-tabs flex",
    activeClass: "is-active",
    orientation: "vertical",
    tabs: [{
      name: "documentation_page",
      title: "Doc Page",
      className: tabClasses
    }, {
      name: "single_page",
      title: "Single Page",
      className: tabClasses
    }, {
      name: "archive_page",
      title: "Archive Page",
      className: tabClasses
    }]
  }, function (tab) {
    if ("documentation_page" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_DocPage__WEBPACK_IMPORTED_MODULE_2__["default"], null);
    } else if ("single_page" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_SinglePage__WEBPACK_IMPORTED_MODULE_3__["default"], null);
    } else if ("archive_page" === tab.name) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_ArchivePage__WEBPACK_IMPORTED_MODULE_4__["default"], null);
    }
  });
}

/***/ }),

/***/ "./src/settings/tabs/Search.js":
/*!*************************************!*\
  !*** ./src/settings/tabs/Search.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Search; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);







function Search() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__["useDispatch"])("core/notices"),
      createSuccessNotice = _useDispatch.createSuccessNotice,
      createErrorNotice = _useDispatch.createErrorNotice;

  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__["useEntityProp"])("root", "site", "ibx_sd_search_post_types"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      postTypes = _useEntityProp2[0],
      setPostTypes = _useEntityProp2[1];
  /**
   * Button Saving state
   *
   * @since 1.0.0
   */


  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      saving = _useState2[0],
      setSaving = _useState2[1];

  function handleSaveSettings() {
    setSaving(true);
    var status = wp.data.dispatch("core").saveSite({
      ibx_sd_search_post_types: postTypes
    }).then(function () {
      createSuccessNotice("Settings Saved!", {
        type: "snackbar"
      });
    }).catch(function (e) {
      createErrorNotice("There was some error saving settings! \nCheck console for more information on error.", {
        type: "snackbar"
      });
      console.log(e);
    });
    setSaving(false);
  }
  /**
   * State object for post types.
   */
  // 1. Array to store checkbox data-value


  var checkedTypes = postTypes;
  console.log(postTypes);
  var types = [];
  Object.keys(sd_vars.post_types).map(function (item) {
    types.push({
      value: item,
      label: item
    });
  }); // 2. Function to check array and set isChecked on callaback

  function getChecked(type) {
    if (checkedTypes.indexOf(type)) {
      return true;
    } else {
      return false;
    }
  } //3. fill checkedTypes array
  //4. handle save settings


  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    id: "textarea-1",
    label: "Select Post Types",
    help: "Select post types to search in.",
    className: "mb-3"
  }, types.map(function (item) {
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["CheckboxControl"], {
      label: item.label,
      "data-value": item.value
    });
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    className: "mt-6 mb-3",
    isPrimary: "true",
    isBusy: saving,
    onClick: handleSaveSettings
  }, "Save Changes"));
}

/***/ }),

/***/ "./src/settings/tabs/SinglePage.js":
/*!*****************************************!*\
  !*** ./src/settings/tabs/SinglePage.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return DocPage; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);







function DocPage() {
  var _useDispatch = Object(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__["useDispatch"])("core/notices"),
      createSuccessNotice = _useDispatch.createSuccessNotice,
      createErrorNotice = _useDispatch.createErrorNotice;
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */


  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_page_sidebar"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      showSidebar = _useEntityProp2[0],
      setShowSidebar = _useEntityProp2[1];

  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_page_permalink"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      showPermalink = _useEntityProp4[0],
      setShowPermalink = _useEntityProp4[1];

  var _useEntityProp5 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_page_breadcrumbs"),
      _useEntityProp6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp5, 2),
      showBreadcrumbs = _useEntityProp6[0],
      setShowBreadcrumbs = _useEntityProp6[1];

  var _useEntityProp7 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_page_comments"),
      _useEntityProp8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp7, 2),
      showComments = _useEntityProp8[0],
      setShowComments = _useEntityProp8[1];

  var _useEntityProp9 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_page_social_share_options"),
      _useEntityProp10 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp9, 2),
      showSocialShare = _useEntityProp10[0],
      setShowSocialShare = _useEntityProp10[1];

  var _useEntityProp11 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_3__["useEntityProp"])("root", "site", "ibx_sd_single_ratings"),
      _useEntityProp12 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp11, 2),
      showRatings = _useEntityProp12[0],
      setShowRatings = _useEntityProp12[1];

  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      saving = _useState2[0],
      setSaving = _useState2[1];

  function handleSaveSettings() {
    setSaving(true);
    var status = wp.data.dispatch("core").saveSite({
      ibx_sd_single_page_sidebar: showSidebar,
      ibx_sd_single_page_permalink: showPermalink,
      ibx_sd_single_page_breadcrumbs: showBreadcrumbs,
      ibx_sd_single_page_comments: showComments,
      ibx_sd_single_page_social_share_options: showSocialShare,
      ibx_sd_single_ratings: showRatings
    }).then(function () {
      createSuccessNotice("Settings Saved!", {
        type: "snackbar"
      });
    }).catch(function (e) {
      createErrorNotice("There was some error saving settings! \nCheck console for more information on error.", {
        type: "snackbar"
      });
      console.log(e);
    });
    setSaving(false);
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Sidebar",
    checked: showSidebar,
    onChange: setShowSidebar
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Doc Title Permalink Copy Icon",
    checked: showPermalink,
    onChange: setShowPermalink
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Breadcrumbs",
    checked: showBreadcrumbs,
    onChange: setShowBreadcrumbs
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Comments",
    checked: showComments,
    onChange: setShowComments
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Social Share options",
    checked: showSocialShare,
    onChange: setShowSocialShare
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: "Show or Hide Ratings Buttons",
    checked: showRatings,
    onChange: setShowRatings
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["Button"], {
    className: "mt-6 mb-3",
    isPrimary: "true",
    isBusy: saving,
    onClick: handleSaveSettings
  }, "Save Changes"));
}

/***/ }),

/***/ "./src/settings/tabs/sections/layout/GridLayoutSettings.js":
/*!*****************************************************************!*\
  !*** ./src/settings/tabs/sections/layout/GridLayoutSettings.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return GridLayoutSettings; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__);






function GridLayoutSettings() {
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */

  /**
   * Documentation Page Doc Icon.
   *
   * Show/hide documentation category icon.
   */
  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__["useEntityProp"])("root", "site", "ibx_sd_doc_page_grid_layout_icon"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      showIcon = _useEntityProp2[0],
      setShowIcon = _useEntityProp2[1];
  /**
   * Documentation Page Columns.
   *
   * Set number of columns.
   */


  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__["useEntityProp"])("root", "site", "ibx_sd_doc_page_grid_layout_columns"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      gridColumns = _useEntityProp4[0],
      setGridColumns = _useEntityProp4[1];

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("hr", {
    className: "my-5"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("h3", {
    className: "my-3 font-semibold"
  }, "Grid Layout Settings"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    label: "Grid Columns",
    className: "inline-number-control"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalNumberControl"], {
    className: "my-3 w-16 ml-4",
    isShiftStepEnabled: true,
    onChange: setGridColumns,
    shiftStep: 1,
    value: gridColumns
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    className: "my-3",
    label: "Show or Hide Doc Category Icon",
    checked: showIcon,
    onChange: setShowIcon
  }));
}

/***/ }),

/***/ "./src/settings/tabs/sections/layout/ListLayoutSettings.js":
/*!*****************************************************************!*\
  !*** ./src/settings/tabs/sections/layout/ListLayoutSettings.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ListLayoutSettings; });
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/* harmony import */ var _wordpress_core_data__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__);






function ListLayoutSettings() {
  /**
   * [Getter, Setter] for SmartDocs Settings
   *
   * @since 1.0.0
   */

  /**
   * Documentation Page Doc Icon.
   *
   * Show/hide documentation category icon.
   */
  var _useEntityProp = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__["useEntityProp"])("root", "site", "ibx_sd_doc_page_list_layout_icon"),
      _useEntityProp2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp, 2),
      showIcon = _useEntityProp2[0],
      setShowIcon = _useEntityProp2[1];
  /**
   * Documentation Page Columns.
   *
   * Set number of columns.
   */


  var _useEntityProp3 = Object(_wordpress_core_data__WEBPACK_IMPORTED_MODULE_4__["useEntityProp"])("root", "site", "ibx_sd_doc_page_list_layout_columns"),
      _useEntityProp4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useEntityProp3, 2),
      listColumns = _useEntityProp4[0],
      setListColumns = _useEntityProp4[1];

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("hr", {
    className: "my-5"
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("h3", {
    className: "my-3 font-semibold"
  }, "List Layout Settings"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["BaseControl"], {
    label: "List Columns",
    className: "inline-number-control"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["__experimentalNumberControl"], {
    className: "my-3 w-16 ml-4",
    isShiftStepEnabled: true,
    onChange: setListColumns,
    shiftStep: 1,
    value: listColumns
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    className: "my-3",
    label: "Show or Hide Doc Category Icon",
    checked: showIcon,
    onChange: setShowIcon
  }));
}

/***/ }),

/***/ "@wordpress/components":
/*!*********************************************!*\
  !*** external {"this":["wp","components"]} ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["components"]; }());

/***/ }),

/***/ "@wordpress/core-data":
/*!*******************************************!*\
  !*** external {"this":["wp","coreData"]} ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["coreData"]; }());

/***/ }),

/***/ "@wordpress/data":
/*!***************************************!*\
  !*** external {"this":["wp","data"]} ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["data"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!******************************************!*\
  !*** external {"this":["wp","element"]} ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["element"]; }());

/***/ }),

/***/ "@wordpress/i18n":
/*!***************************************!*\
  !*** external {"this":["wp","i18n"]} ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["i18n"]; }());

/***/ }),

/***/ "lodash":
/*!**********************************!*\
  !*** external {"this":"lodash"} ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["lodash"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map