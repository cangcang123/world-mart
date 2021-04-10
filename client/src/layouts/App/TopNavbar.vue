<template>
<b-navbar variant="dark" type="dark" class="top-navbar p-0">
    <b-container>
        <b-navbar-nav>
            <b-nav-item href="javascript:void(0)" @click="toggleSidebar" :class="sidebarToggleBtnCls"><i class="mdi mdi-backburger"></i></b-nav-item>
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto" v-if="user">
            <b-nav-item href="javascript:void(0)">
                <!-- <div class="socket-status" :class="connected ? 'sopen' : 'sclose'"></div> -->
            </b-nav-item>
            <b-nav-item href="javascript:void(0)">
                <b-button size="sm" class="mdi mdi-account" @click="popup_info=true" > {{ user.full_name }}</b-button>
            </b-nav-item>
        </b-navbar-nav>
    </b-container>

    <popup-change-pass :show.sync="popup_info" @logout="logout"></popup-change-pass>
</b-navbar>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import PopupChangePass from './PopupChangePass'

export default {
    components: {
        PopupChangePass
    },
    data() {
        return {
            popup_info: false,
        }
    },
    computed: {
        ...mapState({
            toggled: state => state.layout.sidebar.toggled,
            user: state => state.auth.user,
            // connected: state => state.socket.connected
        }),
        sidebarToggleBtnCls() {
            return {
                'sidebar-toggle': true,
                'open': this.toggled
            }
        }
    },
    methods: {
        ...mapActions({
            toggleSidebar: 'layout/toggleSidebar'
        }),
        async logout() {
            this.popup_info = false
            this.$nextTick(() => {
                this.$store.dispatch('auth/logout')
            })
        },
    }
}
</script>

<style lang="scss">
.top-navbar {
    height: 55px;
    background-color: #1d2025 !important;
    // background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgb(0, 21, 46) 100%);

    a {
        line-height: 50px;
        padding-top: 0;
        padding-bottom: 0;
    }
    .sidebar-toggle {
        font-size: 24px;
        .mdi::before {
            transform: rotateY(180deg);
            transition: all 1s;
        }
        &.open {
            .mdi::before {
                transform: rotateY(0deg);
            }
        }
    }

    .socket-status {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: #ffffff;

        &.sopen {
            background-color: #06b900;
        }
        &.sclose {
            background-color: #c94000;
        }
    }
}
</style>
