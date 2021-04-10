<template>
<div class="text-center">
    <el-pagination
        :small="small"
        layout="total, prev, pager, next"
        :total="pagination.total"
        :current-page.sync="pagination.currentPage"
        :page-size="pagination.perPage"
    ></el-pagination>
</div>
</template>

<script>
export default {
    name: 'Pagination',
    inject: ['pagination'],
    data() {
        return {
            small: window.innerWidth <= 500
        }
    },
}
</script>
