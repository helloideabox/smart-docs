!function(e){var t={};function r(o){if(t[o])return t[o].exports;var n=t[o]={i:o,l:!1,exports:{}};return e[o].call(n.exports,n,n.exports,r),n.l=!0,n.exports}r.m=e,r.c=t,r.d=function(e,t,o){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(o,n,function(t){return e[t]}.bind(null,n));return o},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=21)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.data},function(e,t,r){var o=r(16),n=r(17),c=r(10),a=r(18);e.exports=function(e,t){return o(e)||n(e,t)||c(e,t)||a()}},function(e,t){function r(t){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?e.exports=r=function(e){return typeof e}:e.exports=r=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r(t)}e.exports=r},function(e,t){e.exports=function(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}},function(e,t){e.exports=window.wp.compose},function(e,t){e.exports=window.lodash},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,o=new Array(t);r<t;r++)o[r]=e[r];return o}},function(e,t,r){var o=r(9);e.exports=function(e,t){if(e){if("string"==typeof e)return o(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?o(e,t):void 0}}},function(e,t,r){var o=r(13),n=r(14),c=r(10),a=r(15);e.exports=function(e){return o(e)||n(e)||c(e)||a()}},function(e,t,r){},function(e,t,r){var o=r(9);e.exports=function(e){if(Array.isArray(e))return o(e)}},function(e,t){e.exports=function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(e,t){e.exports=function(e){if(Array.isArray(e))return e}},function(e,t){e.exports=function(e,t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e)){var r=[],o=!0,n=!1,c=void 0;try{for(var a,s=e[Symbol.iterator]();!(o=(a=s.next()).done)&&(r.push(a.value),!t||r.length!==t);o=!0);}catch(e){n=!0,c=e}finally{try{o||null==s.return||s.return()}finally{if(n)throw c}}return r}}},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(e,t){e.exports=window.wp.coreData},function(e,t){e.exports=window.wp.notices},function(e,t,r){"use strict";r.r(t);var o=r(0);function n(){return Object(o.createElement)("div",{className:"smartdocs-settings-header mx-auto flex justify-center justify-items-center mb-8 bg-white"},Object(o.createElement)("div",{className:"smartdocs-logo"},Object(o.createElement)("img",{src:smartdocs_admin.logo_url,alt:"Smart Docs"})),Object(o.createElement)("div",{className:"smartdocs-version text-sm text-gray-500"},Object(o.createElement)("span",null,smartdocs_admin.version)))}r(12);var c=r(2),a=r(1),s=r(11),l=r.n(s),i=r(6),m=r.n(i),u=r(4),b=r.n(u),p=r(5),d=r.n(p),_=r(3),f=(r(19),r(7));function O(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function g(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?O(Object(r),!0).forEach((function(t){m()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):O(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var j=Object(f.compose)(Object(_.withSelect)((function(e){var t=e("core").getEntityRecord("root","site"),r={};return t&&["smartdocs_hero_title","smartdocs_hero_description","smartdocs_search_post_types","smartdocs_support_page_url"].forEach((function(e){t[e]&&(r[e]=t[e])})),{postTypes:e("core").getPostTypes(),options:r}})))((function(e){if("object"!==d()(e.options)||0===Object.keys(e.options).length)return Object(o.createElement)(o.Fragment,null,Object(a.__)("Loading...","smart-docs"));var t=Object(o.useState)(e.options),r=b()(t,2),n=r[0],s=r[1],i=[],m=n.smartdocs_search_post_types,u=["attachment","fl-builder-template","elementor_library"];e.postTypes&&e.postTypes.forEach((function(e){e.viewable&&!u.includes(e.slug)&&i.push({value:e.slug,label:e.name})}));var p=Object(o.useState)(m||[]),f=b()(p,2),O=f[0],j=f[1];O!==m&&setPostTypes(O);var h=Object(_.useDispatch)("core/notices"),y=h.createSuccessNotice,v=h.createErrorNotice,E=Object(o.useState)(!1),w=b()(E,2),S=w[0],x=w[1];return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Hero Title","smart-docs"),help:Object(a.__)("Edit to change the default title for the header section.","smart-docs"),className:"mb-3"},Object(o.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(a.__)("Documentation","smart-docs"),value:n.smartdocs_hero_title,onChange:function(e){return s(g(g({},n),{},{smartdocs_hero_title:e}))}})),Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Hero Description","smart-docs"),help:Object(a.__)("Edit to change or add description for header.","smart-docs"),className:"mb-3"},Object(o.createElement)(c.TextareaControl,{className:"mt-2 block mb-2",value:n.smartdocs_hero_description,onChange:function(e){return s(g(g({},n),{},{smartdocs_hero_description:e}))}})),Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Search","smart-docs"),className:"mb-3"},Object(o.createElement)("p",{className:"components-base-control__help"},Object(a.__)("Select post type(s) to include their articles in search result.","smart-docs")),Object(o.createElement)("ul",{className:"post-types-list"},0!==i.length&&i.map((function(e){return Object(o.createElement)("li",{key:e.value},Object(o.createElement)(c.ToggleControl,{label:e.label,checked:"object"===d()(O)&&O.includes(e.value),onChange:function(t){if(t)j((function(t){return[].concat(l()(t),[e.value])}));else{var r=O.filter((function(t){return t!==e.value}));j(r)}}}))})),0===i.length&&Object(o.createElement)("li",null,Object(a.__)("Loading...","smart-docs")))),Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Your Support Page URL","smart-docs"),help:Object(a.__)("Please enter your support or contact page URL.","smart-docs"),className:"smartdocs-field--support-page"},Object(o.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(a.__)("https://example.com/contact/","smart-docs"),value:n.smartdocs_support_page_url,onChange:function(e){return s(g(g({},n),{},{smartdocs_support_page_url:e}))}})),Object(o.createElement)(c.Button,{className:"mt-6 mb-3",isPrimary:"true",isBusy:S,onClick:function(){x(!0),wp.data.dispatch("core").saveSite(n).then((function(){y(Object(a.__)("Settings Saved!","smart-docs"),{type:"snackbar"}),wp.ajax.post("smartdocs_on_settings_save",{})})).catch((function(e){v(Object(a.__)("There was some error saving settings! \nCheck console for more information on error.","smart-docs"),{type:"snackbar"}),console.log(e)})),x(!1)}},Object(a.__)("Save Changes","smart-docs")))}));function h(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function y(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?h(Object(r),!0).forEach((function(t){m()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):h(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var v=Object(f.compose)(Object(_.withSelect)((function(e){var t=e("core").getEntityRecord("root","site"),r={};return t&&["smartdocs_use_built_in_doc_archive","smartdocs_custom_doc_page","smartdocs_archive_page_slug","smartdocs_category_slug","smartdocs_enable_single_template","smartdocs_enable_taxonomy_template"].forEach((function(e){t[e]&&(r[e]=t[e])})),{pages:e("core").getEntityRecords("postType","page"),options:r}})))((function(e){if("object"!==d()(e.options)||0===Object.keys(e.options).length)return Object(o.createElement)(o.Fragment,null,Object(a.__)("Loading...","smart-docs"));var t=Object(o.useState)(e.options),r=b()(t,2),n=r[0],s=r[1],l=[];e.pages?(l.push({label:Object(a.__)("Select a page","smart-docs"),value:null}),e.pages.forEach((function(e){l.push({value:e.id,label:e.title.rendered})}))):l.push({label:Object(a.__)("Loading...","smart-docs"),value:null});var i=Object(_.useDispatch)("core/notices"),m=i.createSuccessNotice,u=i.createErrorNotice,p=Object(o.useState)(!1),f=b()(p,2),O=f[0],g=f[1];return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Rewrite Archive Slug","smart-docs"),help:Object(a.__)("Edit to change the default slug for the documentation archive page.","smart-docs"),className:"mb-3"},Object(o.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(a.__)('Defaults to "docs"',"smart-docs"),value:n.smartdocs_archive_page_slug,onChange:function(e){return s(y(y({},n),{},{smartdocs_archive_page_slug:e}))}})),Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Rewrite Category Slug","smart-docs"),help:Object(a.__)("Edit to change the default slug for the documentation category page.","smart-docs"),className:"mb-3"},Object(o.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(a.__)('Defaults to "docs-category"',"smart-docs"),value:n.smartdocs_category_slug,onChange:function(e){return s(y(y({},n),{},{smartdocs_category_slug:e}))}})),Object(o.createElement)(c.BaseControl,{className:"mt-3 mb-3",label:Object(a.__)("Template","smart-docs")},Object(o.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(a.__)("Use built-in template for Docs archive","smart-docs"),checked:n.smartdocs_use_built_in_doc_archive,onChange:function(e){s(y(y({},n),{},{smartdocs_use_built_in_doc_archive:e}))}}),!n.smartdocs_use_built_in_doc_archive&&Object(o.createElement)(c.BaseControl,{label:Object(a.__)("Select Custom Page","smart-docs"),className:"mb-3",help:Object(a.__)("Note: If you disable built-in documentation archive, you can use shortcode or page builder widgets to design your own documentation page.","smart-docs")},Object(o.createElement)(c.SelectControl,{className:"mt-2 block mb-2",labelPosition:"top",options:l,value:n.smartdocs_custom_doc_page,onChange:function(e){return s(y(y({},n),{},{smartdocs_custom_doc_page:e}))}})),Object(o.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(a.__)("Use built-in template for Docs single page","smart-docs"),checked:n.smartdocs_enable_single_template,onChange:function(e){return s(y(y({},n),{},{smartdocs_enable_single_template:e}))}}),Object(o.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(a.__)("Use built-in template for Docs category page","smart-docs"),checked:n.smartdocs_enable_taxonomy_template,onChange:function(e){return s(y(y({},n),{},{smartdocs_enable_taxonomy_template:e}))}})),Object(o.createElement)(c.Button,{className:"mt-6 mb-3",isPrimary:"true",isBusy:O,onClick:function(){g(!0),wp.data.dispatch("core").saveSite(n).then((function(){m(Object(a.__)("Settings Saved!","smart-docs"),{type:"snackbar"}),wp.ajax.post("smartdocs_on_settings_save",{})})).catch((function(e){u(Object(a.__)("There was some error saving settings! \nCheck console for more information on error.","smart-docs"),{type:"snackbar"}),console.log(e)})),g(!1)}},Object(a.__)("Save Changes","smart-docs")))}));function E(){var e="smartdocs-setting-primary-tab px-4 text-sm";return Object(o.createElement)(c.TabPanel,{className:"smartdocs-settings-tabs m-5 col-span-2 row-span-2 bg-white",activeClass:"is-active",tabs:[{name:"general",title:Object(a.__)("General","smart-docs"),className:e},{name:"advanced",title:Object(a.__)("Advanced","smart-docs"),className:e}]},(function(e){return"general"===e.name?Object(o.createElement)(j,null):"advanced"===e.name?Object(o.createElement)(v,null):void 0}))}function w(){return Object(o.createElement)(c.Card,{className:"smartdocs-side-card col-span-1 m-5 h-fit-content"},Object(o.createElement)(c.CardHeader,{className:"smartdocs-card-header font-bold text-lg pl-5 pt-4 pb-3"},Object(a.__)("Help or Support","smart-docs")),Object(o.createElement)(c.CardBody,null,Object(a.__)("Found an issue? or Have a suggestion?","smart-docs"),Object(o.createElement)("br",null),Object(o.createElement)("br",null),Object(a.__)("We use GitHub to track issues and suggestions. Click the link below to go to our GitHub Page and post issue/suggestion.","smart-docs")),Object(o.createElement)(c.CardFooter,{className:"smartdocs-card-footer pt-4 pb-4"},Object(o.createElement)(c.ExternalLink,{className:"w-full inline-flex font-medium text-sm",href:"https://github.com/helloideabox/smart-docs/issues"},Object(a.__)("Raise a Ticket","smart-docs"))))}var S=r(8);function x(){var e=Object(_.useDispatch)("core/notices").removeNotice,t=Object(_.useSelect)((function(e){return e("core/notices").getNotices()}),[]),r=Object(S.filter)(t,{isDismissible:!0,type:"default"}),n=Object(S.filter)(t,{isDismissible:!1,type:"default"}),a=Object(S.filter)(t,{type:"snackbar"});return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(c.NoticeList,{notices:n,className:"components-notice-list components-editor-notices__pinned"}),Object(o.createElement)(c.NoticeList,{notices:r,className:"components-notice-list components-editor-notices__dismissible",onRemove:e}),Object(o.createElement)(c.SnackbarList,{notices:a,className:"components-snackbar-list components-editor-notices__snackbar",onRemove:e}))}r(20);var N=function(){return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(n,null),Object(o.createElement)("div",{className:"grid grid-cols-3 grid-rows-2 container mx-auto"},Object(o.createElement)(E,null),Object(o.createElement)(w,null)),Object(o.createElement)(x,null))};setTimeout((function(){Object(o.render)(Object(o.createElement)(N,null),document.getElementById("smartdocs-setting-root"))}),0)}]);