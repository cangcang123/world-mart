(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5a4242ff"],{"159b":function(t,e,r){var a=r("da84"),i=r("fdbc"),n=r("17c2"),s=r("9112");for(var c in i){var o=a[c],d=o&&o.prototype;if(d&&d.forEach!==n)try{s(d,"forEach",n)}catch(u){d.forEach=n}}},"17c2":function(t,e,r){"use strict";var a=r("b727").forEach,i=r("a640"),n=r("ae40"),s=i("forEach"),c=n("forEach");t.exports=s&&c?[].forEach:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}},"2ac8":function(t,e,r){"use strict";r.r(e);var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"page-add"},[r("h4",{staticClass:"header py-3"},[t._v("Thêm mới")]),r("div",{staticClass:"bg-white p-3 shadow-sm"},[r("b-form",{staticClass:"submit-form"},[t._l(t.addFields,(function(e,a){return[r("input-field",{key:a,attrs:{field:e},model:{value:t.item[e.key],callback:function(r){t.$set(t.item,e.key,r)},expression:"item[field.key]"}})]}))],2),r("b-form-group",{staticClass:"submit-form"},[r("b-button",{attrs:{type:"submit",variant:"primary"},on:{click:function(e){return e.preventDefault(),t.create(e)}}},[t._v("Submit")]),r("b-button",{staticClass:"mdi mdi-arrow-left",on:{click:function(e){return t.$router.back()}}},[t._v(" Back")])],1)],1)])},i=[],n=(r("b0c0"),r("3ec3")),s=r("56a9"),c={name:"UserTagAdd",mixins:[s["a"]],data:function(){return{item:{status:1},fields:n["a"],districts:[],wards:[],entry:"crm/user-tag"}},methods:{afterCreated:function(t){t&&(this.$bvToast.toast(t.name,{title:"Created",variant:"success"}),this.$router.push({name:"UserTagEdit",params:{id:t.id}}))}}},o=c,d=r("2877"),u=Object(d["a"])(o,a,i,!1,null,null,null);e["default"]=u.exports},"3ec3":function(t,e,r){"use strict";e["a"]=[{key:"id",readonly:!0},{label:"Name",key:"name"},{label:"Description",key:"description"},{label:"Status",key:"status",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Active"},{value:2,text:"InActive"}],thClass:"text-center",tdClass:"text-center",thStyle:{width:"120px"}},{label:"Tạo",key:"created_at",readonly:!0},{key:"created_by",readonly:!0},{label:"Cập Nhật",key:"modified_at",readonly:!0,sortable:!0,thStyle:{width:"200px"}},{key:"modified_by",readonly:!0}]},4160:function(t,e,r){"use strict";var a=r("23e7"),i=r("17c2");a({target:"Array",proto:!0,forced:[].forEach!=i},{forEach:i})},"56a9":function(t,e,r){"use strict";r("4de4"),r("7db0"),r("4160"),r("d81d"),r("159b"),r("96cf");var a=r("1da1"),i=r("9c8c");e["a"]={data:function(){return{fields:[],displayFields:[],item:{}}},computed:{addFields:function(){var t=this;return this.displayFields.length?this.displayFields.map((function(e){return t.fields.find((function(t){return t.key===e}))})).filter((function(t){return t})):this.fields.filter((function(t){return!t.readonly}))}},created:function(){var t=this;this.$service=new i["a"](this.entry),this.addFields.forEach((function(e){void 0===t.item[e.key]&&t.$set(t.item,e.key,void 0===e.default?"":e.default)}))},methods:{create:function(){var t=this;return Object(a["a"])(regeneratorRuntime.mark((function e(){var r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if("function"!==typeof t.beforeCreate){e.next=3;break}if(!1!==t.beforeCreate()){e.next=3;break}return e.abrupt("return");case 3:return e.next=5,t.$service.create(t.item);case 5:r=e.sent,"function"===typeof t.afterCreated&&t.afterCreated(r);case 7:case"end":return e.stop()}}),e)})))()}}}},"7db0":function(t,e,r){"use strict";var a=r("23e7"),i=r("b727").find,n=r("44d2"),s=r("ae40"),c="find",o=!0,d=s(c);c in[]&&Array(1)[c]((function(){o=!1})),a({target:"Array",proto:!0,forced:o||!d},{find:function(t){return i(this,t,arguments.length>1?arguments[1]:void 0)}}),n(c)}}]);