<template>
    <page class="page-message shadow">
        <div class="chat-sidebar">
            <div class="chat-sidebar__header">
                <list-oa></list-oa>
            </div>
            <VuePerfectScrollbar class="chat-sidebar__contacts" :settings="{wheelSpeed: 2}" v-if="sidebarTab == 'message'">
                <search-input></search-input>
                <search-result></search-result>
                <chat-users></chat-users>
            </VuePerfectScrollbar>
            <!-- <sidebar-actions v-model="sidebarTab"></sidebar-actions> -->
        </div>
        <div class="chat-panel-wrapper" :style="{right: show ? '300px': 0}">
            <div class="chat-panel">
                <chat-panel-header @toggleInfo="show = !show"></chat-panel-header>
                <VuePerfectScrollbar class="chat-panel__body" ref="wrap" @ps-scroll-y="onScroll">
                    <chat-panel ref="panel" @scrollBottom="scrollToBottom"></chat-panel>
                </VuePerfectScrollbar>
                <div @click="scrollToBottom" class="scroll-to-bottom shadow mdi mdi-chevron-double-down" v-if="scrollValue > 100"></div>
                <div class="chat-panel__footer" v-if="currentUser">
                    <div class="chat-panel__footer-wrapper">
                        <chat-tags></chat-tags>
                        <chat-input-actions @requestSend="sendImageLink"></chat-input-actions>
                        <chat-input @requestSend="sendMessage"></chat-input>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-client-info" v-if="show && currentUser">
            <chat-info></chat-info>
        </div>
    </page>
</template>

<script>

export default {
    name: 'ChatDashboard',
    components: {

    },
    data() {

    },
    methods: {

    }
}
</script>