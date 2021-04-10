<template>
    <div class="mt-2 mb-2">
        <el-date-picker 
        style="width:250px"
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