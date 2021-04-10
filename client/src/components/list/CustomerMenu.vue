<template>
    <div class="filter-bar mb-4">
        <el-menu class="el-menu" mode="horizontal" text-color="#409EFF">
            <el-menu-item index="0"><router-link to="/user-profiles"><i class="el-icon-s-custom"></i> Profile</router-link></el-menu-item>

            <el-submenu index="1">
                <template slot="title">
                    <i class="el-icon-s-tools"></i> Manager
                </template>
                <!-- <router-link to="/user-tags">
                    <el-menu-item>
                        <i class="el-icon-collection-tag"></i> User Tags
                    </el-menu-item>
                </router-link>
                <router-link to="/crm/conversation-tags">
                    <el-menu-item>
                        <i class="el-icon-chat-dot-square"></i> Conversation Tags
                    </el-menu-item>
                </router-link> -->
            </el-submenu>

            <el-submenu index="2">
                <template slot="title">
                    <i class="el-icon-s-operation"></i> Other
                </template>
                <!-- <router-link to="/log-import">
                    <el-menu-item>
                        <i class="el-icon-files"></i> Logs Import
                    </el-menu-item>
                </router-link>
                <router-link to="/log-export">
                    <el-menu-item>
                        <i class="el-icon-files"></i> Logs Export
                    </el-menu-item>
                </router-link> -->
            </el-submenu>
        </el-menu>
    </div>
</template>

<script>
export default {
    name: 'CustomerMenu',
}
</script>

<style scoped>
.el-menu a {
    all: unset;
}
</style>
