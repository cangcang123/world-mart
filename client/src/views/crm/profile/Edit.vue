<template>
    <div class="page-add">
        <h4 class="header py-3">Edit Profile Information</h4>
        <div class="bg-white p-3 shadow-sm" v-if="item">
            <b-form class="submit-form">
                <template v-for="(field, index) in editFields">
                    <input-field :key="index" v-model="item[field.key]" :field="field">
                        <b-form-select disabled v-model="item.district_code" :options="districts" v-if="field.key === 'district_code'"></b-form-select>
                        <b-form-select disabled v-model="item.ward_code" :options="wards" v-if="field.key === 'ward_code'"></b-form-select>
                    </input-field>
                </template>
            </b-form>
            <b-form-group class="submit-form">
                <b-button type="submit" @click.prevent="save" variant="primary">Save</b-button>
                <b-button @click="$router.back()" class="mdi mdi-arrow-left">Back</b-button>
            </b-form-group>
        </div>
    </div>
</template>

<script>
import fields from './edit_fields'
import Edit from '@/mixins/edit'
import geo from '@/services/geo'

export default {
    name: 'UserProfileEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            displayFields: [
                "full_name",
                "phone",
                "dob",
                "gender",
                "email",
                "address",
                "status"
            ],
            districts: [],
            wards: [],
            entry: 'crm/user-profile'
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        afterGotData(item) {}
    },
    watch: {
        async 'item.province_code'(province_code) {
            if (province_code) {
                let districts = await geo.getDistricts(province_code)
                let field = this.fields.find(f => f.key === 'district_code')
                if (field) {
                    this.districts = geo.geoToSelect(districts)
                }
            } else {
                this.districts = []
            }
        },
        async 'item.district_code'(district_code) {
            if (district_code) {
                let wards = await geo.getWards(district_code)
                let field = this.fields.find(f => f.key === 'district_code')
                if (field) {
                    this.wards = geo.geoToSelect(wards)
                }
            } else {
                this.wards = []
            }
        },
        districts(districts) {
            if (this.item.district_code) {
                if (districts.every(d => d.value !== this.item.district_code)) {
                    this.item.district_code = ''
                }
            }
        },
        wards(wards) {
            if (this.item.ward_code) {
                if (wards.every(d => d.value !== this.item.ward_code)) {
                    this.item.ward_code = ''
                }
            }
        }
    }
}
</script>