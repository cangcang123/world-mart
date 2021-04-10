<template>
    <div class="filter-bar mb-4">
        <el-menu class="el-menu" mode="horizontal" text-color="#409EFF">
            <el-menu-item index="0"><router-link to="/user-follows/oa"><i class="el-icon-s-custom"></i> Follower</router-link></el-menu-item>

            <el-submenu index="1">
                <template slot="title">
                    <i class="el-icon-menu"></i> Menu
                </template>
                <router-link to="/zalo-phone">
                    <el-menu-item>
                        <i class="el-icon-finished"></i> Check Phone On Zalo
                    </el-menu-item>
                </router-link>
            </el-submenu>

            <el-submenu index="2">
                <template slot="title">
                    <i class="el-icon-s-tools"></i> Manager
                </template>
                <router-link to="/user-tags">
                    <el-menu-item>
                        <i class="el-icon-collection-tag"></i> User Tags
                    </el-menu-item>
                </router-link>
                <router-link to="/crm/conversation-tags">
                    <el-menu-item>
                        <i class="el-icon-chat-dot-square"></i> Conversation Tags
                    </el-menu-item>
                </router-link>
            </el-submenu>
        </el-menu>
    </div>
</template>

<script>
export default {
    name: 'FollowerMenu',
}
</script>

<style scoped>
.el-menu a {
    all: unset;
}
</style>
