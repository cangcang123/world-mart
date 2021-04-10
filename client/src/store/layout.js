import Vue from 'vue'
import {
    fields as getEntryFields,
    sync as syncEntryFields
} from '@/services/entry'

export default {
    namespaced: true,
    state: {
        fields: {},
        sidebar: {
            theme: 'default',
            bg: '1',
            toggled: true,
            pinned: false,
            items: []
        }
    },
    mutations: {
        SIDEBAR_TOGGLED({ sidebar }, val) {
            sidebar.toggled = Boolean(val)
        },
        SIDEBAR_PINNED({ sidebar }, val) {
            sidebar.pinned = Boolean(val)
        },
        SIDEBAR_ITEMS({ sidebar }, items) {
            sidebar.items = items || []
        },
        SIDEBAR_THEME({ sidebar }, theme) {
            sidebar.theme = theme
        },
        SIDEBAR_BG({ sidebar }, bg) {
            sidebar.bg = bg
        },
        TABLE_DISPLAY_FIELDS(state, payload) {
            if (payload.entry) {
                Vue.set(state.fields, payload.entry, payload.fields || [])
            }
        }
    },
    getters: {
        display_fields: ({ fields }, getters) => entry => {
            return fields[entry] || []
        }
    },
    actions: {
        toggleSidebar({ commit, state }) {
            commit('SIDEBAR_TOGGLED', !state.sidebar.toggled)
        },
        setSidebarItems({ commit }, items) {
            commit('SIDEBAR_ITEMS', items)
        },
        async getFields({ commit }, entry) {
            let opts = await getEntryFields(entry)
            if (opts.display_fields.length) {
                commit('TABLE_DISPLAY_FIELDS', {
                    entry,
                    fields: opts.display_fields
                })
            }
            return opts.display_fields || []
        },
        async syncFields({ commit }, {entry, fields}) {
            commit('TABLE_DISPLAY_FIELDS', {
                entry,
                fields
            })

            syncEntryFields(entry, fields)
        }
    },
}
