!function(t){var e={};function n(r){if(e[r])return e[r].exports;var a=e[r]={i:r,l:!1,exports:{}};return t[r].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=0)}({"/RxM":function(t,e){},0:function(t,e,n){n("O0Uh"),t.exports=n("/RxM")},GU39:function(t,e){var n;n=jQuery,acf.hasOwnProperty("conditional_logic")&&n.extend(acf.conditional_logic,{calculate:function(t,e,n){if(!e||!n)return!1;var r=!1,a=e.data("type");return"true_false"==a||"checkbox"==a||"radio"==a||"button_group"==a?r=this.calculate_checkbox(t,e):"select"!=a&&"country"!=a||(r=this.calculate_select(t,e)),"!="===t.operator&&(r=!r),r}})},O0Uh:function(t,e,n){!function(t,e){function r(t,e){return'<span class="acf-country-flag-icon famfamfam-flags '+t+'"></span> <span class="acf-country-flag-name">'+e+"</span>"}function a(e,n,a,o){var i=t.fn.select2.defaults.formatResult(e,n,a,o);return r(e.id.toLowerCase(),i)}function o(t,e,n,a){return r(t.id.toLowerCase(),t.text)}function i(e){return e.id?t('<span class="acf-country-flag-icon famfamfam-flags '+e.id.toLowerCase()+'"></span> <span class="acf-country-flag-name">'+e.text+"</span>"):e.text}function c(t){return!("undefined"==typeof acfCountry||!acfCountry.hasOwnProperty(t)||!acfCountry[t])&&acfCountry[t].toString()}function u(e){var n=e.find('[data-ui="1"]');if(n.length){var r=c("select2_version"),u={containerCssClass:"-acf acf-select2-multi-choice",allowClear:!!n.data("allow-null"),width:"100%"};"3"===r?t.extend(u,{formatResult:a,formatSelection:o}):"4"===r&&t.extend(u,{templateResult:i,templateSelection:i}),n.select2(u),n.next(".select2-container").addClass("-acf")}}function f(t){u(t.$el)}function l(t){u(t)}var s=c("acf_version"),d=n("u9Pu");1===d(s,"4.9.99")&&-1===d(s,"5.6")&&n("g+Zm"),1===d(s,"5.5.99")&&-1===d(s,"5.7")&&n("GU39"),1===d(s,"5.6.99")&&(n("ODtN"),acf.add_filter("select2_args",function(e,n,r,a,o){return"country"!==o.data.field.get("type")?e:(t.extend(e,{templateResult:i,templateSelection:i}),e)})),void 0!==acf.addAction?-1===d(s,"5.7")&&(acf.addAction("ready_field/type=country",f),acf.addAction("append_field/type=country",f)):void 0!==acf.add_action?(acf.add_action("ready_field/type=country",l),acf.add_action("append_field/type=country",l)):t(document).on("acf/setup_fields",function(e,n){t(n).find('.field[data-field_type="country"]').each(function(){u(t(this))})})}(jQuery)},ODtN:function(t,e){var n;jQuery,n=acf.models.SelectField.extend({type:"country"}),acf.registerFieldType(n),acf.registerConditionForFieldType("contains","country"),acf.registerConditionForFieldType("selectEqualTo","country"),acf.registerConditionForFieldType("selectNotEqualTo","country")},"g+Zm":function(t,e){var n;n=jQuery,acf.hasOwnProperty("conditional_logic")&&n.extend(acf.conditional_logic,{calculate:function(t,e,r){var a=acf.get_data(e,"type");if("true_false"==a||"checkbox"==a||"radio"==a){var o=e.find('input[value="'+t.value+'"]:checked').exists();if("=="==t.operator&&o)return!0;if("!="==t.operator&&!o)return!0}else if("select"==a||"country"==a){var i=e.find("select"),c=acf.get_data(i),u=[];if(c.multiple&&c.ui?"country"==a?u=i.val():e.find(".acf-select2-multi-choice").each(function(){u.push(n(this).val())}):c.multiple?u=i.val():c.ui?"country"==a?u.push(i.val()):u.push(e.find("input").first().val()):u.push(i.val()),"=="==t.operator){if(n.inArray(t.value,u)>-1)return!0}else if(n.inArray(t.value,u)<0)return!0}return!1}})},u9Pu:function(t,e,n){var r,a,o;a=[],void 0===(o="function"==typeof(r=function(){var t=/^v?(?:\d+)(\.(?:[x*]|\d+)(\.(?:[x*]|\d+)(\.(?:[x*]|\d+))?(?:-[\da-z\-]+(?:\.[\da-z\-]+)*)?(?:\+[\da-z\-]+(?:\.[\da-z\-]+)*)?)?)?$/i;function e(t){var e,n,r=t.replace(/^v/,"").replace(/\+.*$/,""),a=(n="-",-1===(e=r).indexOf(n)?e.length:e.indexOf(n)),o=r.substring(0,a).split(".");return o.push(r.substring(a+1)),o}function n(t){return isNaN(Number(t))?t:Number(t)}function r(e){if("string"!=typeof e)throw new TypeError("Invalid argument expected string");if(!t.test(e))throw new Error("Invalid argument not valid semver ('"+e+"' received)")}return function(t,a){[t,a].forEach(r);for(var o=e(t),i=e(a),c=0;c<Math.max(o.length-1,i.length-1);c++){var u=parseInt(o[c]||0,10),f=parseInt(i[c]||0,10);if(u>f)return 1;if(f>u)return-1}var l=o[o.length-1],s=i[i.length-1];if(l&&s){var d=l.split(".").map(n),p=s.split(".").map(n);for(c=0;c<Math.max(d.length,p.length);c++){if(void 0===d[c]||"string"==typeof p[c]&&"number"==typeof d[c])return-1;if(void 0===p[c]||"string"==typeof d[c]&&"number"==typeof p[c])return 1;if(d[c]>p[c])return 1;if(p[c]>d[c])return-1}}else if(l||s)return l?-1:1;return 0}})?r.apply(e,a):r)||(t.exports=o)}});