<template>
    <div class="py-3">
        <b-row class="py-3">
            <div class="col-xl-3 col-md-6">
                <stats-card>
                    <div slot="header" class="icon-success">
                        <i class="mdi mdi-face-profile text-success"></i>
                    </div>
                    <div slot="content">
                        <p class="card-category"><i class="fa fa-users"></i> Profile</p>
                        <h4 class="card-title">{{ item.total_profile }}</h4>
                    </div>
                    <div slot="footer">
                        <router-link :to="{name: 'UserProfileList'}"><i class="fa fa-info-circle"></i> Detail</router-link>
                    </div>
                </stats-card>
            </div>

        </b-row>
    </div>
</template>

<script>
import StatsCard from '@/components/cards/StatsCard.vue'
import CURD from '@/services/curd'
import geo from "@/services/geo"
import store from '@/store'

export default {
    components: {
        StatsCard
    },
    data() {
        return {
            range: 14,
            time: 0,
            item: {
                total_profile: 0,
            }
        }
    },
    mounted() {
        this.getTotalProfile()
        this.getProvinces()
    },
    methods: {
        async getTotalProfile() {
            let service = new CURD('crm/user-profile/count')
            this.item.total_profile = (await service.count()).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') || 0
        },
        async getProvinces() {
            if (!store.state.crm.provinces.length) {
                await store.dispatch('crm/getProvinces')
            }
        }
    }
}
</script>
