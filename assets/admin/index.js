!function(e){var t={};function o(r){if(t[r])return t[r].exports;var n=t[r]={i:r,l:!1,exports:{}};return e[r].call(n.exports,n,n.exports,o),n.l=!0,n.exports}o.m=e,o.c=t,o.d=function(e,t,r){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(o.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)o.d(r,n,function(t){return e[t]}.bind(null,n));return r},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=21)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.data},function(e,t,o){var r=o(14),n=o(15),c=o(8),a=o(16);e.exports=function(e,t){return r(e)||n(e,t)||c(e,t)||a()}},function(e,t){function o(t){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?e.exports=o=function(e){return typeof e}:e.exports=o=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o(t)}e.exports=o},function(e,t){e.exports=window.wp.compose},function(e,t){e.exports=window.lodash},function(e,t,o){var r=o(9);e.exports=function(e,t){if(e){if("string"==typeof e)return r(e,t);var o=Object.prototype.toString.call(e).slice(8,-1);return"Object"===o&&e.constructor&&(o=e.constructor.name),"Map"===o||"Set"===o?Array.from(e):"Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o)?r(e,t):void 0}}},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var o=0,r=new Array(t);o<t;o++)r[o]=e[o];return r}},function(e,t){e.exports=function(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}},function(e,t,o){var r=o(17),n=o(18),c=o(8),a=o(19);e.exports=function(e){return r(e)||n(e)||c(e)||a()}},function(e,t){e.exports=window.wp.coreData},function(e,t,o){},function(e,t){e.exports=function(e){if(Array.isArray(e))return e}},function(e,t){e.exports=function(e,t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e)){var o=[],r=!0,n=!1,c=void 0;try{for(var a,s=e[Symbol.iterator]();!(r=(a=s.next()).done)&&(o.push(a.value),!t||o.length!==t);r=!0);}catch(e){n=!0,c=e}finally{try{r||null==s.return||s.return()}finally{if(n)throw c}}return o}}},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(e,t,o){var r=o(9);e.exports=function(e){if(Array.isArray(e))return r(e)}},function(e,t){e.exports=function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(e,t){e.exports=window.wp.notices},function(e,t,o){"use strict";o.r(t);var r=o(0);function n(){return Object(r.createElement)(r.Fragment,null,Object(r.createElement)("div",{className:"smartdocs-settings-header mx-auto flex justify-center justify-items-center mb-8 bg-white"},Object(r.createElement)("div",{className:"smartdocs-logo"},Object(r.createElement)("img",{src:smartdocs_admin.logo_url,alt:"Smart Docs"})),Object(r.createElement)("div",{className:"smartdocs-version text-sm text-gray-500"},Object(r.createElement)("span",null,smartdocs_admin.version))))}o(13);var c=o(2),a=o(10),s=o.n(a),l=o(4),i=o.n(l),u=o(5),m=o.n(u),b=o(3),d=o(6),p=o(1);function _(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,r)}return o}function f(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?_(Object(o),!0).forEach((function(t){s()(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):_(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}var g=Object(d.compose)(Object(b.withSelect)((function(e){var t=e("core").getEntityRecord("root","site"),o={};return t&&["smartdocs_use_built_in_doc_archive","smartdocs_custom_doc_page","smartdocs_archive_page_title","smartdocs_archive_page_slug","smartdocs_category_slug","smartdocs_tag_slug","smartdocs_enable_single_template","smartdocs_enable_category_and_tag_template","smartdocs_support_page_url"].forEach((function(e){t[e]&&(o[e]=t[e])})),{pages:e("core").getEntityRecords("postType","page"),options:o}})))((function(e){if("object"!==m()(e.options)||0===Object.keys(e.options).length)return Object(r.createElement)(r.Fragment,null,Object(p.__)("Loading...","smart-docs"));var t=Object(r.useState)(e.options),o=i()(t,2),n=o[0],a=o[1],s=[];e.pages?(s.push({label:Object(p.__)("Select a page","smart-docs"),value:null}),e.pages.forEach((function(e){s.push({value:e.id,label:e.title.rendered})}))):s.push({label:Object(p.__)("Loading...","smart-docs"),value:null});var l=Object(b.useDispatch)("core/notices"),u=l.createSuccessNotice,d=l.createErrorNotice,_=Object(r.useState)(!1),g=i()(_,2),j=g[0],O=g[1];return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(p.__)("Use built-in Docs archive","smart-docs"),help:Object(p.__)("Note: If you disable built-in documentation archive, you can use shortcode or page builder widgets to design your own documentation page.","smart-docs"),checked:n.smartdocs_use_built_in_doc_archive,onChange:function(e){a(f(f({},n),{},{smartdocs_use_built_in_doc_archive:e}))}}),!n.smartdocs_use_built_in_doc_archive&&Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Select Custom Page","smart-docs"),className:"mb-3"},Object(r.createElement)(c.SelectControl,{className:"mt-2 block mb-2",labelPosition:"top",options:s,value:n.smartdocs_custom_doc_page,onChange:function(e){return a(f(f({},n),{},{smartdocs_custom_doc_page:e}))}})),Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Hero Title","smart-docs"),help:Object(p.__)("Edit to change the default title for the header section.","smart-docs"),className:"mb-3"},Object(r.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(p.__)("Documentation","smart-docs"),value:n.smartdocs_archive_page_title,onChange:function(e){return a(f(f({},n),{},{smartdocs_archive_page_title:e}))}})),Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Rewrite Archive Slug","smart-docs"),help:Object(p.__)("Edit to change the default slug for the documentation archive page.","smart-docs"),className:"mb-3"},Object(r.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(p.__)('Defaults to "docs"',"smart-docs"),value:n.smartdocs_archive_page_slug,onChange:function(e){return a(f(f({},n),{},{smartdocs_archive_page_slug:e}))}})),Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Rewrite Category Slug","smart-docs"),help:Object(p.__)("Edit to change the default slug for the documentation category page.","smart-docs"),className:"mb-3"},Object(r.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(p.__)('Defaults to "docs-category"',"smart-docs"),value:n.smartdocs_category_slug,onChange:function(e){return a(f(f({},n),{},{smartdocs_category_slug:e}))}})),Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Rewrite Tag Slug","smart-docs"),help:Object(p.__)("Edit to change the default slug for the documentation tag.","smart-docs")},Object(r.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(p.__)('Defaults to "docs-tag"',"smart-docs"),value:n.smartdocs_tag_slug,onChange:function(e){return a(f(f({},n),{},{smartdocs_tag_slug:e}))}})),Object(r.createElement)(c.BaseControl,{className:"mt-3 mb-3",label:Object(p.__)("Template","smart-docs")},Object(r.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(p.__)("Use built-in template for Docs single page","smart-docs"),checked:n.smartdocs_enable_single_template,onChange:function(e){return a(f(f({},n),{},{smartdocs_enable_single_template:e}))}}),Object(r.createElement)(c.ToggleControl,{className:"mt-2 mb-2",label:Object(p.__)("Use built-in template for Docs category page","smart-docs"),checked:n.smartdocs_enable_category_and_tag_template,onChange:function(e){return a(f(f({},n),{},{smartdocs_enable_category_and_tag_template:e}))}})),Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Your Support Page URL","smart-docs"),help:Object(p.__)("Please enter your support or contact page URL.","smart-docs"),className:"smartdocs-field--support-page mt-3"},Object(r.createElement)(c.TextControl,{className:"mt-2 block mb-2",placeholder:Object(p.__)("https://example.com/contact/","smart-docs"),value:n.smartdocs_support_page_url,onChange:function(e){return a(f(f({},n),{},{smartdocs_support_page_url:e}))}})),Object(r.createElement)(c.Button,{className:"mt-6 mb-3",isPrimary:"true",isBusy:j,onClick:function(){O(!0),wp.data.dispatch("core").saveSite(n).then((function(){u(Object(p.__)("Settings Saved!","smart-docs"),{type:"snackbar"}),wp.ajax.post("smartdocs_on_settings_save",{})})).catch((function(e){d(Object(p.__)("There was some error saving settings! \nCheck console for more information on error.","smart-docs"),{type:"snackbar"}),console.log(e)})),O(!1)}},Object(p.__)("Save Changes","smart-docs")))})),j=o(11),O=o.n(j),h=o(12),y=Object(d.compose)(Object(b.withSelect)((function(e){return{postTypes:e("core").getPostTypes()}})))((function(e){var t=Object(b.useDispatch)("core/notices"),o=t.createSuccessNotice,n=t.createErrorNotice,a=Object(h.useEntityProp)("root","site","smartdocs_search_post_types"),s=i()(a,2),l=s[0],u=s[1],d=[];e.postTypes&&e.postTypes.forEach((function(e){e.viewable&&"attachment"!==e.slug&&d.push({value:e.slug,label:e.name})}));var _=Object(r.useState)(l||[]),f=i()(_,2),g=f[0],j=f[1];g!==l&&u(g);var y=Object(r.useState)(!1),v=i()(y,2),E=v[0],w=v[1];return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(c.BaseControl,{label:Object(p.__)("Select Post Types","smart-docs"),help:Object(p.__)("Select post type(s) to include their articles in search result.","smart-docs"),className:"mb-3"},Object(r.createElement)("ul",{className:"post-types-list"},0!==d.length&&d.map((function(e){return Object(r.createElement)("li",{key:e.value},Object(r.createElement)(c.ToggleControl,{label:e.label,checked:"object"===m()(g)&&g.includes(e.value),onChange:function(t){if(t)j((function(t){return[].concat(O()(t),[e.value])}));else{var o=g.filter((function(t){return t!==e.value}));j(o)}}}))})),0===d.length&&Object(r.createElement)("li",null,Object(p.__)("Loading...","smart-docs")))),Object(r.createElement)(c.Button,{className:"mt-6 mb-3",isPrimary:"true",isBusy:E,onClick:function(){w(!0),wp.data.dispatch("core").saveSite({smartdocs_search_post_types:l}).then((function(){o(Object(p.__)("Settings Saved!","smart-docs"),{type:"snackbar"})})).catch((function(e){n(Object(p.__)("There was some error saving settings! \nCheck console for more information on error.","smart-docs"),{type:"snackbar"}),console.log(e)})),w(!1)}},Object(p.__)("Save Changes","smart-docs")))}));function v(){var e="smartdocs-setting-primary-tab px-4 text-sm";return Object(r.createElement)(c.TabPanel,{className:"smartdocs-settings-tabs m-5 col-span-2 row-span-2 bg-white",activeClass:"is-active",tabs:[{name:"general",title:"General",className:e},{name:"search",title:"Search",className:e}]},(function(e){return"general"===e.name?Object(r.createElement)(g,null):"search"===e.name?Object(r.createElement)(y,null):void 0}))}function E(){return Object(r.createElement)(c.Card,{className:"smartdocs-side-card col-span-1 m-5 h-fit-content"},Object(r.createElement)(c.CardHeader,{className:"smartdocs-card-header font-bold text-lg pl-5 pt-4 pb-3"},"Help or Support"),Object(r.createElement)(c.CardBody,null,"Found a issue? or Have a suggestion? ",Object(r.createElement)("br",null),Object(r.createElement)("br",null),"We use Github to track issues and suggestions. Click the link below to go to our Github Page and post issue/suggestion."),Object(r.createElement)(c.CardFooter,{className:"smartdocs-card-footer pt-4 pb-4"},Object(r.createElement)(c.ExternalLink,{className:"w-full inline-flex font-medium text-sm",href:"https://github.com/helloideabox/smart-docs/issues"},"Raise a Ticket")))}var w=o(7);function S(){var e=Object(b.useDispatch)("core/notices").removeNotice,t=Object(b.useSelect)((function(e){return e("core/notices").getNotices()}),[]),o=Object(w.filter)(t,{isDismissible:!0,type:"default"}),n=Object(w.filter)(t,{isDismissible:!1,type:"default"}),a=Object(w.filter)(t,{type:"snackbar"});return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(c.NoticeList,{notices:n,className:"components-notice-list components-editor-notices__pinned"}),Object(r.createElement)(c.NoticeList,{notices:o,className:"components-notice-list components-editor-notices__dismissible",onRemove:e}),Object(r.createElement)(c.SnackbarList,{notices:a,className:"components-snackbar-list components-editor-notices__snackbar",onRemove:e}))}o(20);var x=function(){return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(n,null),Object(r.createElement)("div",{className:"grid grid-cols-3 grid-rows-2 container mx-auto"},Object(r.createElement)(v,null),Object(r.createElement)(E,null)),Object(r.createElement)(S,null))};setTimeout((function(){Object(r.render)(Object(r.createElement)(x,null),document.getElementById("smartdocs-setting-root"))}),0)}]);