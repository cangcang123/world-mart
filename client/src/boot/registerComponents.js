import Vue from 'vue'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'

const LocaleChanger = () => import('@/components/helpers/LocaleChanger')
Vue.component('LocaleChanger', LocaleChanger)

/** LIST */
const ActionBar = () => import('@/components/list/ActionBar')
const Pagination = () => import('@/components/list/Pagination')
const CustomerMenu = () => import('@/components/list/CustomerMenu')
const FollowerMenu = () => import('@/components/list/FollowerMenu')
Vue.component('ActionBar', ActionBar)
Vue.component('Pagination', Pagination)
Vue.component('CustomerMenu', CustomerMenu)
Vue.component('FollowerMenu', FollowerMenu)

/** PAGE */
const Page = () => import('@/components/page/Page')
const PageHeader = () => import('@/components/page/PageHeader')
const PageBody = () => import('@/components/page/PageBody')
Vue.component('Page', Page)
Vue.component('PageHeader', PageHeader)
Vue.component('PageBody', PageBody)



/** FORM */
const InputField = () => import('@/components/form/InputField')
Vue.component('InputField', InputField)
const InputFieldMentions = () => import('@/components/form/InputFieldMentions')
Vue.component('InputFieldMentions', InputFieldMentions)
const ImageInput = () => import('@/components/form/input/ImageInput')
Vue.component('ImageInput', ImageInput)
const ImageInputMulti = () => import('@/components/form/input/ImageInputMulti')
Vue.component('ImageInputMulti', ImageInputMulti)
const ImageMulti = () => import('@/components/form/input/ImageMulti')
Vue.component('ImageMulti', ImageMulti)
Vue.component('VuePerfectScrollbar', VuePerfectScrollbar)

/** DATE RANGE PICKER */
const DateRange = () => import('@/components/datepicker/DateRange')
Vue.component('DateRange', DateRange)
const DateRangeCustom = () => import('@/components/datepicker/DateRangeCustom')
Vue.component('DateRangeCustom', DateRangeCustom)