<template>
    <div>
        <el-date-picker
        v-model="date"
        type="daterange"
        unlink-panels
        size='small'
        range-separator="-"
        start-placeholder="Start date"
        end-placeholder="End date"
        @change="onChangeTime()"
        :picker-options="pickerOptions">
        </el-date-picker>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        date: null,
        chartKey: 0,
        pickerOptions: {
            shortcuts: [{
                text: 'Last week',
                onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                }
            }, {
                text: 'Last month',
                onClick(picker) {
                    const end = new Date();
                    const start = new Date();
                    start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                    picker.$emit('pick', [start, end]);
                }
            }, {
            text: 'This Month',
                onClick (picker) {
                    const end = new Date();
                    const start = new Date();
                    const firstDay = new Date(start.getFullYear(), start.getMonth(), 1);
                    picker.$emit('pick', [firstDay, end]);
                }
            }, {
            text: 'Last 30 Days',
                onClick (picker) {
                    const end = new Date();
                    const start = new Date();
                    start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                    picker.$emit('pick', [start, end]);
                }
            }]
        },
        value1: '',
        value2: ''
      };
    },
    methods: {
        onChangeTime() {
            let arr = [];
            this.chartKey++
            if (this.date) {
                arr.push(moment(this.date[0]).format('YYYY-MM-DD'))
                arr.push(moment(this.date[1]).format('YYYY-MM-DD'))
            }
            this.$emit("update:component", this.chartKey);
            this.$emit("update:time", arr);
        },
    }
  };
</script>