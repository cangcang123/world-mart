import Vue from 'vue'
import Highcharts from 'highcharts';
import HighchartsVue from 'highcharts-vue'
import noDataInit from 'highcharts/modules/no-data-to-display'
// import loadDrillDown from 'highcharts/modules/drilldown'

// loadDrillDown(Highcharts)
noDataInit(Highcharts)
Highcharts.setOptions({
    title: {
        text: ''
    }, 
    chart: {
    },
    credits: {
        enabled: false,
        href: 'https://google.com.vn/',
        text: 'Shopping'
    }
})

Vue.use(HighchartsVue)