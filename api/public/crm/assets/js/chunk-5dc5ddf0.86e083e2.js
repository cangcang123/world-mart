(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5dc5ddf0"],{"159b":function(t,e,r){var i=r("da84"),n=r("fdbc"),a=r("17c2"),o=r("9112");for(var c in n){var s=i[c],u=s&&s.prototype;if(u&&u.forEach!==a)try{o(u,"forEach",a)}catch(d){u.forEach=a}}},"17c2":function(t,e,r){"use strict";var i=r("b727").forEach,n=r("a640"),a=r("ae40"),o=n("forEach"),c=a("forEach");t.exports=o&&c?[].forEach:function(t){return i(this,t,arguments.length>1?arguments[1]:void 0)}},4160:function(t,e,r){"use strict";var i=r("23e7"),n=r("17c2");i({target:"Array",proto:!0,forced:[].forEach!=n},{forEach:n})},"42b0":function(t,e,r){"use strict";r.r(e);var i=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("page",[r("page-header",{attrs:{header:"🅱️ Add Brand"}}),t.item?r("page-body",{staticClass:"p-3"},[r("b-jumbotron",{attrs:{"bg-variant":"white","text-variant":"white","border-variant":"dark"}},[r("b-row",[r("b-col",{attrs:{lg:"12"}},[r("b-card",{attrs:{"bg-variant":"light","text-variant":"dark","header-bg-variant":"dark","header-text-variant":"white"}},[r("input-field",{attrs:{field:t.getField("name"),state:t.$v.item["name"]&&t.$v.item["name"].$dirty?!t.$v.item["name"].$error:null,error:t.fieldError(t.getField("name"))},model:{value:t.item.name,callback:function(e){t.$set(t.item,"name",e)},expression:"item.name"}}),r("input-field",{attrs:{field:t.getField("description"),state:t.$v.item["description"]&&t.$v.item["description"].$dirty?!t.$v.item["description"].$error:null,error:t.fieldError(t.getField("description"))}},[r("b-textarea",{attrs:{rows:"6"},model:{value:t.item.description,callback:function(e){t.$set(t.item,"description",e)},expression:"item.description"}})],1),r("input-field",{attrs:{field:t.getField("distributor"),state:t.$v.item["distributor"]&&t.$v.item["distributor"].$dirty?!t.$v.item["distributor"].$error:null,error:t.fieldError(t.getField("distributor"))},model:{value:t.item.distributor,callback:function(e){t.$set(t.item,"distributor",e)},expression:"item.distributor"}}),r("input-field",{attrs:{field:t.getField("country"),state:t.$v.item["country"]&&t.$v.item["country"].$dirty?!t.$v.item["country"].$error:null,error:t.fieldError(t.getField("country"))},model:{value:t.item.country,callback:function(e){t.$set(t.item,"country",e)},expression:"item.country"}}),r("input-field",{attrs:{field:t.getField("logo"),state:t.$v.item["logo"]&&t.$v.item["logo"].$dirty?!t.$v.item["logo"].$error:null,error:t.fieldError(t.getField("logo"))},model:{value:t.item.logo,callback:function(e){t.$set(t.item,"logo",e)},expression:"item.logo"}}),r("input-field",{attrs:{field:t.getField("status")},model:{value:t.item.status,callback:function(e){t.$set(t.item,"status",e)},expression:"item.status"}}),r("div",{staticClass:"text-center"},[r("b-btn",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"mr-5 w-25 mdi mdi-content-save",attrs:{variant:"success",title:"Create"},on:{click:t.create}}),r("b-btn",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],staticClass:"w-25 mdi mdi-undo",attrs:{to:{name:"BrandList"},title:"Back"}})],1)],1)],1)],1)],1)],1):t._e()],1)},n=[],a=(r("7db0"),r("b0c0"),r("5530")),o=r("a189"),c=r("56a9"),s=r("67d8"),u=r("b5ae"),d={name:"BrandAdd",mixins:[c["a"],s["a"]],data:function(){return{state:0,fields:o["a"],entry:"crm/brand",displayFields:["name","description","country","logo","status"]}},methods:{beforeCreate:function(){return this.$v.item.$touch(),!this.$v.item.$anyError},afterCreated:function(t){var e=this;t&&(this.$bvToast.toast(t.name,{title:"Created",variant:"success"}),setTimeout((function(){e.$router.go(e.$router.currentRoute)}),500))},getField:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=this.fields.find((function(e){return e.key==t}));return r?Object(a["a"])({},r,{},e):null}},validations:{item:{name:{required:u["required"],minLength:Object(u["minLength"])(2)}}}},l=d,f=r("2877"),b=Object(f["a"])(l,i,n,!1,null,null,null);e["default"]=b.exports},5530:function(t,e,r){"use strict";r.d(e,"a",(function(){return a}));r("a4d3"),r("4de4"),r("4160"),r("e439"),r("dbb4"),r("b64b"),r("159b");var i=r("ade3");function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,i)}return r}function a(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){Object(i["a"])(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}},"56a9":function(t,e,r){"use strict";r("4de4"),r("7db0"),r("4160"),r("d81d"),r("159b"),r("96cf");var i=r("1da1"),n=r("9c8c");e["a"]={data:function(){return{fields:[],displayFields:[],item:{}}},computed:{addFields:function(){var t=this;return this.displayFields.length?this.displayFields.map((function(e){return t.fields.find((function(t){return t.key===e}))})).filter((function(t){return t})):this.fields.filter((function(t){return!t.readonly}))}},created:function(){var t=this;this.$service=new n["a"](this.entry),this.addFields.forEach((function(e){void 0===t.item[e.key]&&t.$set(t.item,e.key,void 0===e.default?"":e.default)}))},methods:{create:function(){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if("function"!==typeof t.beforeCreate){e.next=3;break}if(!1!==t.beforeCreate()){e.next=3;break}return e.abrupt("return");case 3:return e.next=5,t.$service.create(t.item);case 5:r=e.sent,"function"===typeof t.afterCreated&&t.afterCreated(r);case 7:case"end":return e.stop()}}),e)})))()}}}},"67d8":function(t,e,r){"use strict";r("4de4"),r("d81d"),r("b64b");var i=r("a2b6");e["a"]={methods:{fieldError:function(t){var e=this,r=t.key;if(this.$v.item[r]&&this.$v.item[r].$anyError){var n=Object.keys(this.$v.item[r].$params);return n.filter((function(t){return!1===e.$v.item[r][t]})).map((function(n){return Object(i["b"])(t,n,e.$v.item[r].$params[n])}))[0]}return""}}}},"7db0":function(t,e,r){"use strict";var i=r("23e7"),n=r("b727").find,a=r("44d2"),o=r("ae40"),c="find",s=!0,u=o(c);c in[]&&Array(1)[c]((function(){s=!1})),i({target:"Array",proto:!0,forced:s||!u},{find:function(t){return n(this,t,arguments.length>1?arguments[1]:void 0)}}),a(c)},a189:function(t,e,r){"use strict";r("96cf");var i=r("1da1"),n=r("4360"),a=r("aca0");e["a"]=[{key:"id",readonly:!0},{label:"Logo",key:"logo",type:"image"},{label:"Brand Name",key:"name",sortable:!0},{label:"Desciption",key:"description"},{label:"Nhà phân phối",key:"distributor"},{label:"Country",key:"country",type:"select",sortable:!0,options:function(){var t=Object(i["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(n["a"].state.crm.countries.length){t.next=3;break}return t.next=3,n["a"].dispatch("crm/getCountries");case 3:return t.abrupt("return",a["a"].geoToSelectCountry(n["a"].state.crm.countries));case 4:case"end":return t.stop()}}),t)})));function e(){return t.apply(this,arguments)}return e}()},{label:"Slug",key:"slug",readonly:!0},{label:"Status",key:"status",type:"select",sortable:!0,options:[{value:0,text:"Undefined"},{value:1,text:"On"},{value:2,text:"Off"}]},{label:"Created Date",key:"created_at",sortable:!0,readonly:!0}]},ade3:function(t,e,r){"use strict";function i(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}r.d(e,"a",(function(){return i}))},b64b:function(t,e,r){var i=r("23e7"),n=r("7b0b"),a=r("df75"),o=r("d039"),c=o((function(){a(1)}));i({target:"Object",stat:!0,forced:c},{keys:function(t){return a(n(t))}})},dbb4:function(t,e,r){var i=r("23e7"),n=r("83ab"),a=r("56ef"),o=r("fc6a"),c=r("06cf"),s=r("8418");i({target:"Object",stat:!0,sham:!n},{getOwnPropertyDescriptors:function(t){var e,r,i=o(t),n=c.f,u=a(i),d={},l=0;while(u.length>l)r=n(i,e=u[l++]),void 0!==r&&s(d,e,r);return d}})},e439:function(t,e,r){var i=r("23e7"),n=r("d039"),a=r("fc6a"),o=r("06cf").f,c=r("83ab"),s=n((function(){o(1)})),u=!c||s;i({target:"Object",stat:!0,forced:u,sham:!c},{getOwnPropertyDescriptor:function(t,e){return o(a(t),e)}})}}]);