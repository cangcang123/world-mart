<template>
<page>
    <page-header header="🕐 Pending jobs">
        <el-button @click="getDelayedJobs" slot="actions" size="mini" icon="el-icon-refresh" type="primary" plain>Cập nhật</el-button>
    </page-header>

    <b-table class="bg-white shadow-sm" :items="items" :fields="fields" show-empty>
        <template v-slot:cell(options)="data">
            <el-button @click="requestRemoveJob(data.item)" size="mini" type="warning" plain icon="el-icon-folder-delete">Hủy bỏ</el-button>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import axios from 'axios'
import List from '@/mixins/list'
import { buildURL } from '@/helpers/utils'
import moment from 'moment'

const API_URL = process.env.VUE_APP_API_URL

export default {
    mixins: [List],
    data() {
        return {
            fields: [
                'id',
                'displayName',
                {
                    label: 'Thời gian',
                    key: 'data.command.delay',
                    formatter(value) {
                        let m = moment(value)
                        return m.format('HH:mm:ss DD-MM-YYYY') + ' (' + m.fromNow() + ')'
                    }
                },
                'attempts',
                {
                    label: 'Tùy chọn',
                    key: 'options'
                }
            ],
            total: 0
        }
    },
    mounted() {
        this.getDelayedJobs()
    },
    methods: {
        getData() {
            return this.getDelayedJobs()
        },
        async getDelayedJobs() {
            this.loading = true
            let res = await axios
                .get(this.buildURL('delayed'), {
                    params: {
                        page: this.pagination.currentPage
                    }
                })
                .then(res => res.data)
                .catch(() => null)
            this.loading = false

            if (res) {
                this.items = res.jobs || []
                this.pagination.total = res.count
            }
        },
        async removeJob(id) {
            axios.delete(this.buildURL('delayed', id)).then(() => {
                this.getDelayedJobs()
            })
        },
        async requestRemoveJob(job) {
            let m = moment(job.data.command.delay)
            let delay = m.format('HH:mm:ss DD-MM-YYYY') + ' (' + m.fromNow() + ')'
            await this.$bvModal
                .msgBoxConfirm(
                    `Xác nhận xóa công việc đã hẹn giờ lúc ${delay}`,
                    {
                        title: 'Please Confirm',
                        size: 'sm',
                        buttonSize: 'sm',
                        okVariant: 'danger',
                        okTitle: 'YES',
                        cancelTitle: 'NO',
                        footerClass: 'p-2',
                        hideHeaderClose: false,
                        centered: true
                    }
                )
                .then(ok => {
                    if (ok) {
                        this.removeJob(job.id)
                    }
                })
                .catch(err => {
                    alert(err.message)
                })
        },
        buildURL: buildURL.bind(null, API_URL, 'admin/queue')
    }
}
</script>