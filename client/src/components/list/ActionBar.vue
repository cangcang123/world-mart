<template>
<div class="filter-bar mb-4">
    <b-row>
        <b-col>
            <el-button @click="visible = !visible" :plain="!visible" type="primary" class="mdi mdi-filter-variant" size="small"> Filter</el-button>
            <el-button v-b-modal.modal-columns size="small" plain type="primary">Columns</el-button>
            <slot name="append-left"></slot>
        </b-col>
        <b-col><slot name="header-right"></slot></b-col>
    </b-row>
    <b-collapse id="collapse-filter-bar" v-model="visible" class="mt-3">
        <b-row no-gutters class="bg-white p-2 shadow-sm rounded">
            <b-col sm="12" md="6" lg="4" xl="3" v-for="field in filterableFields" :key="field.key">
                <div class="box">
                    <input-field v-model="filter[field.key]" :field="field" filter></input-field>
                </div>
            </b-col>
        </b-row>

        <b-card class="mt-3" v-if="false">
            <b-button size="sm" @click="resetFilter" variant="outline-primary" class="mdi mdi-notification-clear-all"> Clear filters</b-button>
        </b-card>
    </b-collapse>

    <b-modal id="modal-columns" title="Select display columns" footer-class="justify-content-between">
        <b-form-select v-model="selectedDisplayFields"
            value-field="key"
            text-field="key"
            disabled-field="hidden"
            :select-size="fields.length"
            :options="options"
            multiple
            autofocus
            >
        </b-form-select>
        <template v-slot:modal-footer="{ ok }">
            <b-button variant="success" @click="resetColumns" class="align-self-start">Reset</b-button>
            <b-button variant="primary" @click="ok()">Done</b-button>
        </template>
    </b-modal>
</div>
</template>

<script>
import debounce from 'lodash/debounce'
import { mapGetters } from 'vuex'
import pick from 'lodash/pick'

export default {
    name: 'ActionBar',
    inject: ['defaultFilter', 'filter', 'fields', 'displayFields', 'entry'],
    data() {
        return {
            options: this.fields.map(f => pick(f, ['key', 'label'])),
            visible: false
        }
    },
    created() {
        this.filterableFields.forEach(field => {
            if (this.$route.query[field.key] == undefined) {
                this.$set(this.filter, field.key, this.defaultFilter[field.key])
            }
        })
        this.$watch('filter', this.onChangeDebounce, { deep: true })
    },
    computed: {
        filterableFields() {
            let fields = []
            for (const key in this.defaultFilter) {
                const field = this.fields.find(f => f.key === key)
                if (field) fields.push(field)
            }
            return fields
        },
        selectedDisplayFields: {
            get() {
                return this.$store.getters["layout/display_fields"](this.entry)
            },
            set: debounce(function(fields) {
                this.$store.dispatch('layout/syncFields', {
                    entry: this.entry,
                    fields
                })
            }, 400)
        }
    },
    methods: {
        onChangeDebounce: debounce(function() {
            let filter = {}
            for (const key in this.filter) {
                if (Object.hasOwnProperty.call(this.filter, key)) {
                    const value = this.filter[key]
                    if (value !== undefined && value !== '') {
                        filter[key] = value
                    }
                }
            }
            this.$router.push({
                path: this.$route.path,
                query: filter
            })
            this.$emit('change', this.filter)
        }, 500),
        resetFilter() {
            for (const key in this.filter) {
                this.$set(this.filter, key, this.defaultFilter[key])
            }
        },
        resetColumns() {
            this.selectedDisplayFields = [].concat([], this.displayFields)
        },
        updateQueryFilter() {
            for (const key in this.defaultFilter) {
                if (this.$route.query[key] !== undefined) {
                    let value = this.$route.query[key]

                    if (!isNaN(value) && typeof this.filter[key] == 'number') value = +value
                    this.$set(this.filter, key, value)
                }
            }
        }
    },
    watch: {
        visible(show) {
            if (!show) this.resetFilter()
        },
        "$route.query"(query) {
            this.updateQueryFilter()
        }
    }
}
</script>


<style lang="scss">
.filter-bar {
    border-radius: 4px;


    .header {
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        user-select: none;
        line-height: 30px;
        font-size: 20px;

        &.active {
            color: cornflowerblue;
        }
    }

    .box {
        min-height: 30px;
        margin: 10px 6px;

        .form-group {
            margin-bottom: 4px;
        }
    }
}
</style>
