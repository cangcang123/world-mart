<template>
<div class="page-wrapper sidebar-bg boder-radius-on" :class="pageWrapper">
    <main-sidebar></main-sidebar>
    <!-- page-content  -->
    <main class="page-content">
        <top-navbar></top-navbar>
        <div @click="toggleSidebar" id="overlay" class="overlay"></div>
        <b-container class="page-container" :class="messagePage ? 'page-message-container' : ''">
            <!-- <transition name="el-fade-in-linear" mode="out-in"> -->
                <router-view></router-view>
            <!-- </transition> -->
        </b-container>
        <transition name="el-fade-in-linear">
            <!-- <chatbox-bar v-if="!messagePage"></chatbox-bar> -->
        </transition>
    </main>
    <!-- page-content" -->
</div>
</template>

<script>
import TopNavbar from './TopNavbar'
import MainSidebar from './MainSidebar'
import { mapState, mapActions } from 'vuex'

export default {
    name: 'App',
    components: {
        TopNavbar,
        MainSidebar
    },
    computed: {
        ...mapState({
            user: state => state.auth.user,
            token: state => state.auth.token,
            toggled: state => state.layout.sidebar.toggled,
            pinned: state => state.layout.sidebar.pinned,
            themeClass: state => state.layout.sidebar.theme ? state.layout.sidebar.theme + '-theme' : 'default-theme',
            themeBg: state => state.layout.sidebar.bg ? 'bg' + state.layout.sidebar.bg : 'bg1',
            messagePage: state => state.message.messagePage
        }),
        pageWrapper() {
            let obj = {
                toggled: this.toggled,
                pinned: this.pinned,
            }
            obj[this.themeClass] = true
            obj[this.themeBg] = true
            return obj
        },
    },
    mounted() {
        if (this.user) {
        }
    },
    methods: {
        ...mapActions({
            toggleSidebar: 'layout/toggleSidebar'
        })
    }
}
</script>

<style lang="scss">
.page-container {
    min-height: calc(100vh - 75px);
    margin: 10px auto;
    max-width: 2000px;
}
.page-press-enter-active, .page-press-leave-active {
    transition: all .4s;
}
.page-press-enter, .page-press-leave-to {
    opacity: .7;
    transform: scale(.97);
}
</style>
