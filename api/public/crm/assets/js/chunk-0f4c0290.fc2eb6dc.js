(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0f4c0290"],{"4cc7":function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("page",{staticClass:"page-add"},[n("page-header",[e._v("Edit Package")]),e.item?n("div",{staticClass:"bg-white p-3 shadow-sm"},[n("b-form",{staticClass:"submit-form"},[e._l(e.editFields,(function(t,a){return[n("input-field",{key:a,attrs:{field:t},model:{value:e.item[t.key],callback:function(n){e.$set(e.item,t.key,n)},expression:"item[field.key]"}})]}))],2),n("b-form-group",{staticClass:"submit-form"},[n("b-button",{attrs:{type:"submit",variant:"primary"},on:{click:function(t){return t.preventDefault(),e.save(t)}}},[e._v("Save")]),n("b-button",{staticClass:"mdi mdi-arrow-left",on:{click:function(t){return e.$router.back()}}},[e._v("Back")])],1)],1):e._e()],1)},r=[],i=n("af75"),s=n("88f5"),o={name:"AdminPackageEdit",mixins:[s["a"]],data:function(){return{fields:i["a"],displayFields:["name","is_publish","state","status"],entry:"admin/packages"}},mounted:function(){this.getData()},methods:{afterGotData:function(e){}}},c=o,u=n("2877"),f=Object(u["a"])(c,a,r,!1,null,null,null);t["default"]=f.exports},7156:function(e,t,n){var a=n("861d"),r=n("d2bb");e.exports=function(e,t,n){var i,s;return r&&"function"==typeof(i=t.constructor)&&i!==n&&a(s=i.prototype)&&s!==n.prototype&&r(e,s),e}},"7db0":function(e,t,n){"use strict";var a=n("23e7"),r=n("b727").find,i=n("44d2"),s=n("ae40"),o="find",c=!0,u=s(o);o in[]&&Array(1)[o]((function(){c=!1})),a({target:"Array",proto:!0,forced:c||!u},{find:function(e){return r(this,e,arguments.length>1?arguments[1]:void 0)}}),i(o)},"88f5":function(e,t,n){"use strict";n("4de4"),n("7db0"),n("d81d"),n("a9e3"),n("96cf");var a=n("1da1"),r=n("9c8c");t["a"]={props:{id:{type:[String,Number],required:!0}},data:function(){return{fields:[],displayFields:[],item:null,loading:!1}},computed:{editFields:function(){var e=this;return this.displayFields.map((function(t){return e.fields.find((function(e){return e.key===t}))})).filter((function(e){return e}))}},created:function(){this.$service=new r["a"](this.entry),this.displayFields.length||(this.displayFields=this.fields.map((function(e){return e.key})))},methods:{getData:function(){var e=this;return Object(a["a"])(regeneratorRuntime.mark((function t(){var n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return e.loading=!0,t.next=3,e.$service.detail(e.id);case 3:n=t.sent,"function"===typeof e.afterGotData&&e.afterGotData(n),e.item=n,e.loading=!1;case 7:case"end":return t.stop()}}),t)})))()},save:function(){var e=this;return Object(a["a"])(regeneratorRuntime.mark((function t(){var n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(e.loading=!0,"function"!==typeof e.beforeSave){t.next=4;break}if(!1!==e.beforeSave()){t.next=4;break}return t.abrupt("return");case 4:return t.next=6,e.$service.update(e.id,e.item).catch((function(t){e.$bvToast.toast(t.response&&t.response.data&&t.response.data.message||t.message,{title:"Error",variant:"danger"})}));case 6:n=t.sent,"function"===typeof e.afterSave&&e.afterSave(n),n&&(e.item=n,e.$bvToast.toast("Item has been updated",{title:"Success",variant:"success"})),e.loading=!1;case 10:case"end":return t.stop()}}),t)})))()},requestDelete:function(){var e=this;this.$bvModal.msgBoxConfirm("Please confirm that you want to delete this item.",{title:"Please Confirm",okVariant:"danger",okTitle:"YES"}).then(function(){var t=Object(a["a"])(regeneratorRuntime.mark((function t(n){var a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!n){t.next=5;break}return t.next=3,e.$service.delete(e.id);case 3:a=t.sent,a?(e.$router.back(),e.$message({message:"This item deleted successful",type:"warning"})):e.$message.error("⚠️☠️⛔ Oops!");case 5:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()).catch((function(e){console.log(e.message)}))}}}},a9e3:function(e,t,n){"use strict";var a=n("83ab"),r=n("da84"),i=n("94ca"),s=n("6eeb"),o=n("5135"),c=n("c6b6"),u=n("7156"),f=n("c04e"),d=n("d039"),l=n("7c73"),p=n("241c").f,m=n("06cf").f,v=n("9bf2").f,h=n("58a8").trim,b="Number",y=r[b],g=y.prototype,k=c(l(g))==b,w=function(e){var t,n,a,r,i,s,o,c,u=f(e,!1);if("string"==typeof u&&u.length>2)if(u=h(u),t=u.charCodeAt(0),43===t||45===t){if(n=u.charCodeAt(2),88===n||120===n)return NaN}else if(48===t){switch(u.charCodeAt(1)){case 66:case 98:a=2,r=49;break;case 79:case 111:a=8,r=55;break;default:return+u}for(i=u.slice(2),s=i.length,o=0;o<s;o++)if(c=i.charCodeAt(o),c<48||c>r)return NaN;return parseInt(i,a)}return+u};if(i(b,!y(" 0o1")||!y("0b1")||y("+0x1"))){for(var x,I=function(e){var t=arguments.length<1?0:e,n=this;return n instanceof I&&(k?d((function(){g.valueOf.call(n)})):c(n)!=b)?u(new y(w(t)),n,I):w(t)},N=a?p(y):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),_=0;N.length>_;_++)o(y,x=N[_])&&!o(I,x)&&v(I,x,m(y,x));I.prototype=g,g.constructor=I,s(r,b,I)}},af75:function(e,t,n){"use strict";t["a"]=[{key:"id",readonly:!0},{key:"name"},{key:"is_publish",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Published"},{value:2,text:"Unpublished"}]},{key:"state"},{key:"status",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Active"},{value:2,text:"Inactive"}]},{key:"created_at",readonly:!0},{key:"modified_at",readonly:!0},{key:"modified_by",readonly:!0}]}}]);