<template>
<page>
    <page-header header="Settings"></page-header>

    <b-card no-body>
        <b-tabs pills card>
            <b-tab title="Preferences" active>
                <b-form-group label="Theme">
                    <b-form-select v-model="sidebarTheme" :options="sidebarThemes"></b-form-select>
                </b-form-group>
                <b-form-group label="Sidebar Background" class="sidebar-bg">
                    <b-img @click="sidebarBg = '1'" :class="{selected: sidebarBg == '1'}" thumbnail width="100" src="@/assets/img/bg1.jpg"></b-img>
                    <b-img @click="sidebarBg = '2'" :class="{selected: sidebarBg == '2'}" thumbnail width="100" src="@/assets/img/bg2.jpg"></b-img>
                    <b-img @click="sidebarBg = '3'" :class="{selected: sidebarBg == '3'}" thumbnail width="100" src="@/assets/img/bg3.jpg"></b-img>
                    <b-img @click="sidebarBg = '4'" :class="{selected: sidebarBg == '4'}" thumbnail width="100" src="@/assets/img/bg4.jpg"></b-img>
                </b-form-group>
            </b-tab>
        </b-tabs>
    </b-card>
</page>
</template>

<script>
export default {
    name: 'AdminSettings',
    data() {
        return {
            sidebarThemes: [
                { value: 'default', text: 'Default'},
                { value: 'chiller', text: 'Chiller' },
                { value: 'legacy', text: 'Legacy' },
                { value: 'cool', text: 'Cool' },
                { value: 'ice', text: 'Ice' },
                { value: 'light', text: 'Light'},
            ]
        }
    },
    computed: {
        sidebarTheme: {
            get() {
                return this.$store.state.layout.sidebar.theme || 'default'
            },
            set(theme) {
                this.$store.commit('layout/SIDEBAR_THEME', theme)
            }
        },
        sidebarBg: {
            get() {
                return this.$store.state.layout.sidebar.bg || '1'
            },
            set(bg) {
                this.$store.commit('layout/SIDEBAR_BG', bg)
            }
        }
    }
}
</script>

<style lang="scss">
.sidebar-bg {
    .img-thumbnail {
        cursor: pointer;
    }
    .selected {
        background-color: dodgerblue;
    }
}
</style>
