(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-62218ebe"],{"159b":function(e,t,r){var n=r("da84"),a=r("fdbc"),i=r("17c2"),o=r("9112");for(var s in a){var c=n[s],l=c&&c.prototype;if(l&&l.forEach!==i)try{o(l,"forEach",i)}catch(u){l.forEach=i}}},"17c2":function(e,t,r){"use strict";var n=r("b727").forEach,a=r("a640"),i=r("ae40"),o=a("forEach"),s=i("forEach");e.exports=o&&s?[].forEach:function(e){return n(this,e,arguments.length>1?arguments[1]:void 0)}},2532:function(e,t,r){"use strict";var n=r("23e7"),a=r("5a34"),i=r("1d80"),o=r("ab13");n({target:"String",proto:!0,forced:!o("includes")},{includes:function(e){return!!~String(i(this)).indexOf(a(e),arguments.length>1?arguments[1]:void 0)}})},4160:function(e,t,r){"use strict";var n=r("23e7"),a=r("17c2");n({target:"Array",proto:!0,forced:[].forEach!=a},{forEach:a})},5530:function(e,t,r){"use strict";r.d(t,"a",(function(){return i}));r("a4d3"),r("4de4"),r("4160"),r("e439"),r("dbb4"),r("b64b"),r("159b");var n=r("ade3");function a(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function i(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(Object(r),!0).forEach((function(t){Object(n["a"])(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}},"55c3":function(e,t,r){"use strict";r("99af"),r("4de4"),r("caad"),r("d81d"),r("d3b7"),r("2532"),r("ddb0"),r("96cf");var n=r("1da1"),a=r("5530"),i=r("2f62"),o=r("9c8c");t["a"]={provide:function(){return{pagination:this.pagination,defaultFilter:this.defaultFilter,filter:this.filter,fields:this.fields,displayFields:this.displayFields,where:this.where,entry:this.entry}},data:function(){var e=parseInt(this.$route.query.page)||1;return{fields:[],displayFields:[],appendColumns:[],items:[],itemsSelected:[],defaultFilter:{},filter:{},where:{},sort:"",defaultSort:void 0,pagination:{currentPage:e,perPage:12,total:0},loading:!1}},computed:Object(a["a"])({},Object(i["c"])({storeDisplayFields:"layout/display_fields"}),{tableFields:function(){var e=this.storeDisplayFields(this.entry);return e.length||(e=this.displayFields),this.fields.filter((function(t){return e.includes(t.key)})).concat(this.appendColumns)}}),created:function(){var e=this;return Object(n["a"])(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:for(r in e.defaultFilter)void 0!==e.$route.query[r]&&(n=e.$route.query[r],isNaN(n)||"oa_id"==r||(n=+n),e.$set(e.filter,r,n));e.$service=new o["a"](e.entry),e.$store.dispatch("layout/getFields",e.entry).then((function(t){t.length&&(e.displayFields=t)}));case 3:case"end":return t.stop()}}),t)})))()},methods:{getData:function(){var e=this;return Object(n["a"])(regeneratorRuntime.mark((function t(){var r,n,a,i,o,s;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=Math.max(1,e.pagination.currentPage),n=e.pagination.perPage,a=(r-1)*n,i=e.sort||e.defaultSort,o=Object.assign({},e.defaultFilter,e.filter),o=Object.assign({},e.where,e.filter),e.loading=!0,t.next=9,e.$service.list({sort:i,filter:o,offset:a,limit:n});case 9:s=t.sent,e.loading=!1,s&&(e.items=s.entries||[],e.pagination.perPage=s.pageInfo.perPage,e.pagination.total=s.totalCount,e.$nextTick((function(){e.pagination.currentPage=s.pageInfo.currentPage})),"function"===typeof e.afterGotData&&e.afterGotData(e.items));case 12:case"end":return t.stop()}}),t)})))()},exportExcel:function(e,t){var r=this;return Object(n["a"])(regeneratorRuntime.mark((function n(){var a,i,o;return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:r.modalShow=!0,a=r.sort||r.defaultSort,i=Object.assign({},r.defaultFilter,r.filter),o=r.storeDisplayFields(r.entry),o.length||(o=r.displayFields),r.loading=!0,r.$service.export({sort:a,type:e,time:t,filter:i,fields:o}).catch((function(){r.$bvToast.toast("Không thể export dữ liệu",{variant:"danger",title:"Lỗi"})})),r.loading=!1;case 8:case"end":return n.stop()}}),n)})))()},onFilterChanged:function(){this.pagination.currentPage=1,this.getData()},onSortChanged:function(e){if(e.sortBy){var t=e.sortDesc?"-":"";this.sort=t+e.sortBy}else this.sort="";this.getData()},showConfirmDeleteModal:function(){var e=this;return Object(n["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.$bvModal.msgBoxConfirm("Please confirm that you want to delete ".concat(e.itemsSelected.length," rows."),{title:"Please Confirm",size:"sm",buttonSize:"sm",okVariant:"danger",okTitle:"YES",cancelTitle:"NO",footerClass:"p-2",hideHeaderClose:!1,centered:!0}).then((function(t){e._deleteSelectedRows()})).catch((function(e){}));case 2:e.getData();case 3:case"end":return t.stop()}}),t)})))()},_rowSelected:function(e){this.itemsSelected=e},_deleteSelectedRows:function(){this.$service.deleteByIds(this.itemsSelected.map((function(e){return e.id})))}},beforeRouteUpdate:function(e,t,r){this.pagination.currentPage=parseInt(e.query.page)||1,r()},watch:{"pagination.currentPage":function(e){var t=this;e!=this.$route.query.page&&this.$router.push({path:this.$route.path,query:Object.assign({},this.$route.query,{page:e})}),this.$nextTick((function(){t.getData()}))}}}},"5a34":function(e,t,r){var n=r("44e7");e.exports=function(e){if(n(e))throw TypeError("The method doesn't accept regular expressions");return e}},"7db0":function(e,t,r){"use strict";var n=r("23e7"),a=r("b727").find,i=r("44d2"),o=r("ae40"),s="find",c=!0,l=o(s);s in[]&&Array(1)[s]((function(){c=!1})),n({target:"Array",proto:!0,forced:c||!l},{find:function(e){return a(this,e,arguments.length>1?arguments[1]:void 0)}}),i(s)},"8fb7":function(e,t,r){"use strict";r.r(t);var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("page",[r("page-header",[e._v("🗳 Order Products")]),r("customer-menu"),r("action-bar",{on:{change:e.onFilterChanged}}),r("div",{staticClass:"mb-2"},[e.loading?r("span",[e._v("Đang tải...")]):r("span",[e._v("Tổng "+e._s(e.pagination.total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g,"$1,")))])]),r("b-table",{staticClass:"bg-white shadow-sm",attrs:{"table-class":"mb-0",items:e.items,fields:e.tableFields,busy:e.loading,"show-empty":"",striped:"",hover:"",responsive:"",selectable:"","no-local-sorting":""},on:{"sort-changed":e.onSortChanged,"row-selected":e._rowSelected},scopedSlots:e._u([{key:"table-busy",fn:function(){return[r("div",{staticClass:"text-center my-2"},[r("b-spinner",{staticClass:"align-middle",attrs:{small:"",variant:"warning",type:"grow"}}),r("b-spinner",{staticClass:"align-middle",attrs:{small:"",variant:"success",type:"grow"}}),r("b-spinner",{staticClass:"align-middle",attrs:{small:"",variant:"info",type:"grow"}})],1)]},proxy:!0},{key:"cell(status)",fn:function(t){return[0===t.value?r("b-badge",{attrs:{variant:"dark"}},[e._v("Undefined")]):e._e(),1===t.value?r("b-badge",{attrs:{variant:"success"}},[e._v("Completed")]):e._e()]}},{key:"cell(cover_photo)",fn:function(t){return[t.value?r("b-img",{attrs:{thumbnail:"",fluid:"",src:t.value,width:"100"}}):r("p",[e._v(" N/A ")])]}},{key:"cell(options)",fn:function(e){return[r("b-button-group")]}}])}),r("pagination",{staticClass:"mt-3"})],1)},a=[],i=(r("7db0"),r("b0c0"),r("5530")),o=r("55c3"),s=[{key:"id",readonly:!0},{label:"Photo",key:"cover_photo",sortable:!0},{label:"Name",key:"name",sortable:!0},{label:"Order ID",key:"order_id",sortable:!0},{label:"Mã đơn hàng",key:"order_code",sortable:!0},{label:"User",key:"user_id",sortable:!0},{label:"Product",key:"product_id",sortable:!0},{label:"Tên sản phẩm",key:"product_name",sortable:!0},{label:"Category",key:"category",sortable:!0},{label:"Brand",key:"brand",sortable:!0},{label:"Country",key:"origin",sortable:!0},{label:"Số lượng",key:"quantity",sortable:!0},{label:"Gía",key:"price",sortable:!0},{label:"Hoa hồng",key:"commission",sortable:!0},{label:"Status",key:"status",type:"select",options:[{value:0,text:"Undefined"},{value:1,text:"Completed"}]},{label:"Ngày tạo",key:"created_at",readonly:!0},{label:"Người tạo",key:"created_by",readonly:!0},{label:"Ngày sửa",key:"modified_at",readonly:!0,sortable:!0},{label:"Người sửa",key:"modified_by",readonly:!0}],c=r("2f62"),l=(r("a2b6"),r("bc3a"),{name:"OrderProductList",mixins:[o["a"]],data:function(){return{showButton:!1,value:0,showDetailId:null,importRes:null,time:null,fields:s,displayFields:["id","name","cover_photo","order_id","user_id","product_id","product_name","quantity","price","commission","modified_at"],appendColumns:["options"],defaultFilter:{name:"",order_id:"",user_id:"",order_code:"",product_id:"",product_name:"",quantity:"",price:""},file:"",defaultSort:"-id",entry:"crm/order-product"}},computed:Object(i["a"])({},Object(c["d"])({provinces:function(e){return e.crm.provinces}})),mounted:function(){this.getData()},methods:{provinceName:function(e){var t=this.provinces.find((function(t){return t.code==e}));return t?t.name:"N/A"}}}),u=l,d=r("2877"),f=Object(d["a"])(u,n,a,!1,null,null,null);t["default"]=f.exports},ab13:function(e,t,r){var n=r("b622"),a=n("match");e.exports=function(e){var t=/./;try{"/./"[e](t)}catch(r){try{return t[a]=!1,"/./"[e](t)}catch(n){}}return!1}},ade3:function(e,t,r){"use strict";function n(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}r.d(t,"a",(function(){return n}))},b64b:function(e,t,r){var n=r("23e7"),a=r("7b0b"),i=r("df75"),o=r("d039"),s=o((function(){i(1)}));n({target:"Object",stat:!0,forced:s},{keys:function(e){return i(a(e))}})},dbb4:function(e,t,r){var n=r("23e7"),a=r("83ab"),i=r("56ef"),o=r("fc6a"),s=r("06cf"),c=r("8418");n({target:"Object",stat:!0,sham:!a},{getOwnPropertyDescriptors:function(e){var t,r,n=o(e),a=s.f,l=i(n),u={},d=0;while(l.length>d)r=a(n,t=l[d++]),void 0!==r&&c(u,t,r);return u}})},e439:function(e,t,r){var n=r("23e7"),a=r("d039"),i=r("fc6a"),o=r("06cf").f,s=r("83ab"),c=a((function(){o(1)})),l=!s||c;n({target:"Object",stat:!0,forced:l,sham:!s},{getOwnPropertyDescriptor:function(e,t){return o(i(e),t)}})}}]);