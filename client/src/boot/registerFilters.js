import Vue from 'vue'
import Currency from '@/filters/currency'
import FDate from '@/filters/date'
import TimeAgo from '@/filters/timeago'

Vue.filter('currency', Currency)
Vue.filter('fdate', FDate)
Vue.filter('ago', TimeAgo)