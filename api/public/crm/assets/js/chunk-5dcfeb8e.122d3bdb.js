(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5dcfeb8e"],{"159b":function(e,t,r){var n=r("da84"),a=r("fdbc"),i=r("17c2"),s=r("9112");for(var o in a){var c=n[o],u=c&&c.prototype;if(u&&u.forEach!==i)try{s(u,"forEach",i)}catch(d){u.forEach=i}}},"17bb":function(e,t,r){"use strict";r("96cf");var n=r("1da1"),a=r("c7a8"),i=r("4360");t["a"]=[{key:"id",readonly:!0},{label:"Role",key:"role_id",sortable:!0,type:"select",options:function(){var e=Object(n["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(i["a"].state.admin.roles.length){e.next=3;break}return e.next=3,i["a"].dispatch("admin/getRoles");case 3:return e.abrupt("return",a["a"].toSelect(i["a"].state.admin.roles));case 4:case"end":return e.stop()}}),e)})));function t(){return e.apply(this,arguments)}return t}()},{key:"resource",sortable:!0,variant:"info"},{key:"permissions",readonly:!0},{label:"Publish",key:"is_publish",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Published"},{value:2,text:"Unpublished"}]},{key:"state"},{key:"status",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Active"},{value:2,text:"Inactive"}]},{key:"created_at",readonly:!0},{label:"Cập Nhật",key:"modified_at",readonly:!0},{key:"modified_by",readonly:!0}]},"17c2":function(e,t,r){"use strict";var n=r("b727").forEach,a=r("a640"),i=r("ae40"),s=a("forEach"),o=i("forEach");e.exports=s&&o?[].forEach:function(e){return n(this,e,arguments.length>1?arguments[1]:void 0)}},4160:function(e,t,r){"use strict";var n=r("23e7"),a=r("17c2");n({target:"Array",proto:!0,forced:[].forEach!=a},{forEach:a})},"56a9":function(e,t,r){"use strict";r("4de4"),r("7db0"),r("4160"),r("d81d"),r("159b"),r("96cf");var n=r("1da1"),a=r("9c8c");t["a"]={data:function(){return{fields:[],displayFields:[],item:{}}},computed:{addFields:function(){var e=this;return this.displayFields.length?this.displayFields.map((function(t){return e.fields.find((function(e){return e.key===t}))})).filter((function(e){return e})):this.fields.filter((function(e){return!e.readonly}))}},created:function(){var e=this;this.$service=new a["a"](this.entry),this.addFields.forEach((function(t){void 0===e.item[t.key]&&e.$set(e.item,t.key,void 0===t.default?"":t.default)}))},methods:{create:function(){var e=this;return Object(n["a"])(regeneratorRuntime.mark((function t(){var r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if("function"!==typeof e.beforeCreate){t.next=3;break}if(!1!==e.beforeCreate()){t.next=3;break}return t.abrupt("return");case 3:return t.next=5,e.$service.create(e.item);case 5:r=t.sent,"function"===typeof e.afterCreated&&e.afterCreated(r);case 7:case"end":return t.stop()}}),t)})))()}}}},"75ea":function(e,t,r){"use strict";r.r(t);var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"page-add"},[r("h4",{staticClass:"header py-3"},[e._v("Thêm mới")]),r("div",{staticClass:"bg-white p-3 shadow-sm"},[r("b-form",{staticClass:"submit-form"},[e._l(e.addFields,(function(t,n){return[r("input-field",{key:n,attrs:{field:t},model:{value:e.item[t.key],callback:function(r){e.$set(e.item,t.key,r)},expression:"item[field.key]"}},["role_id"===t.key?r("b-form-select",{attrs:{options:e.roles},model:{value:e.item.role_id,callback:function(t){e.$set(e.item,"role_id",t)},expression:"item.role_id"}}):e._e(),"resource"===t.key?r("b-form-select",{attrs:{options:e.resources},model:{value:e.item.resource,callback:function(t){e.$set(e.item,"resource",t)},expression:"item.resource"}}):e._e()],1)]}))],2),r("b-form-group",{staticClass:"submit-form"},[r("b-button",{attrs:{type:"submit",variant:"primary"},on:{click:function(t){return t.preventDefault(),e.create(t)}}},[e._v("Submit")]),r("b-button",{staticClass:"mdi mdi-arrow-left",on:{click:function(t){return e.$router.back()}}},[e._v(" Back")])],1)],1)])},a=[],i=(r("d81d"),r("b0c0"),r("d3b7"),r("ddb0"),r("96cf"),r("1da1")),s=r("17bb"),o=r("56a9"),c=r("9c8c"),u={name:"PermissionRoleAdd",mixins:[o["a"]],data:function(){return{item:{},fields:s["a"],packages:[],roles:[],resources:[],entry:"admin/permission-role"}},mounted:function(){this.getRoles(),this.getResources()},methods:{afterCreated:function(e){e&&(this.$bvToast.toast(e.name,{title:"Created",variant:"success"}),this.$router.push({name:"PermissionRoleEdit",params:{id:e.id}}))},getPackages:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=new c["a"]("admin/packages"),t.next=3,r.list();case 3:if(t.t0=t.sent.entries,t.t0){t.next=6;break}t.t0=[];case 6:n=t.t0,e.packages=n.map((function(e){return{value:e.id,text:e.name}}));case 8:case"end":return t.stop()}}),t)})))()},getRoles:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=new c["a"]("admin/roles"),t.next=3,r.list();case 3:if(t.t0=t.sent.entries,t.t0){t.next=6;break}t.t0=[];case 6:n=t.t0,e.roles=n.map((function(e){return{value:e.id,text:e.name}}));case 8:case"end":return t.stop()}}),t)})))()},getResources:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=new c["a"]("admin/resources"),t.next=3,r.list({limit:100});case 3:if(t.t0=t.sent.entries,t.t0){t.next=6;break}t.t0=[];case 6:n=t.t0,e.resources=n.map((function(e){return{value:e.name,text:e.name}}));case 8:case"end":return t.stop()}}),t)})))()}}},d=u,l=r("2877"),f=Object(l["a"])(d,n,a,!1,null,null,null);t["default"]=f.exports},"7db0":function(e,t,r){"use strict";var n=r("23e7"),a=r("b727").find,i=r("44d2"),s=r("ae40"),o="find",c=!0,u=s(o);o in[]&&Array(1)[o]((function(){c=!1})),n({target:"Array",proto:!0,forced:c||!u},{find:function(e){return a(this,e,arguments.length>1?arguments[1]:void 0)}}),i(o)}}]);