(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6303e42b"],{5164:function(e,t,s){e.exports=s.p+"assets/img/bg1.74aaeeb9.jpg"},"7bba":function(e,t,s){"use strict";s.r(t);var a=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("page",[a("page-header",{attrs:{header:"Settings"}}),a("b-card",{attrs:{"no-body":""}},[a("b-tabs",{attrs:{pills:"",card:""}},[a("b-tab",{attrs:{title:"Preferences",active:""}},[a("b-form-group",{attrs:{label:"Theme"}},[a("b-form-select",{attrs:{options:e.sidebarThemes},model:{value:e.sidebarTheme,callback:function(t){e.sidebarTheme=t},expression:"sidebarTheme"}})],1),a("b-form-group",{staticClass:"sidebar-bg",attrs:{label:"Sidebar Background"}},[a("b-img",{class:{selected:"1"==e.sidebarBg},attrs:{thumbnail:"",width:"100",src:s("5164")},on:{click:function(t){e.sidebarBg="1"}}}),a("b-img",{class:{selected:"2"==e.sidebarBg},attrs:{thumbnail:"",width:"100",src:s("8de0")},on:{click:function(t){e.sidebarBg="2"}}}),a("b-img",{class:{selected:"3"==e.sidebarBg},attrs:{thumbnail:"",width:"100",src:s("b691")},on:{click:function(t){e.sidebarBg="3"}}}),a("b-img",{class:{selected:"4"==e.sidebarBg},attrs:{thumbnail:"",width:"100",src:s("9cdf")},on:{click:function(t){e.sidebarBg="4"}}})],1)],1)],1)],1)],1)},i=[],r={name:"AdminSettings",data:function(){return{sidebarThemes:[{value:"default",text:"Default"},{value:"chiller",text:"Chiller"},{value:"legacy",text:"Legacy"},{value:"cool",text:"Cool"},{value:"ice",text:"Ice"},{value:"light",text:"Light"}]}},computed:{sidebarTheme:{get:function(){return this.$store.state.layout.sidebar.theme||"default"},set:function(e){this.$store.commit("layout/SIDEBAR_THEME",e)}},sidebarBg:{get:function(){return this.$store.state.layout.sidebar.bg||"1"},set:function(e){this.$store.commit("layout/SIDEBAR_BG",e)}}}},c=r,n=(s("ee71"),s("2877")),l=Object(n["a"])(c,a,i,!1,null,null,null);t["default"]=l.exports},"8de0":function(e,t,s){e.exports=s.p+"assets/img/bg2.b4e3503f.jpg"},"9cdf":function(e,t,s){e.exports=s.p+"assets/img/bg4.23d3b8d4.jpg"},b691:function(e,t,s){e.exports=s.p+"assets/img/bg3.e6ccd3da.jpg"},c1b3:function(e,t,s){},ee71:function(e,t,s){"use strict";var a=s("c1b3"),i=s.n(a);i.a}}]);