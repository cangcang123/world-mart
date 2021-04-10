<template>
    <nav id="sidebar" class="sidebar-wrapper">
        <VuePerfectScrollbar class="sidebar-content" :settings="settings">
            <div class="sidebar-item sidebar-brand text-center">
                <router-link to="/">
                <br>
                <h5>Shopping Admin</h5>
                </router-link>
            </div>
            <div class="sidebar-item sidebar-menu">
                <ul>
                    <template v-for="(item, index) in items">
                        <li :key="index" :class="itemClass(item)">
                            <template v-if="item.header">
                                <span>{{ item.text }}</span>
                            </template>
                            <template v-else>
                                <router-link
                                    :to="item.to || '#'"
                                    v-b-toggle="`sidebar-collapse-${index}`"
                                >
                                    <i
                                        :style="{backgroundColor: item.color}"
                                        :class="item.icon || 'mdi mdi-package-variant-closed'"
                                    ></i>
                                    <span class="menu-text" v-text="item.text"></span>
                                </router-link>
                                <b-collapse
                                    v-if="item.children && item.children.filter(c => c.to).length"
                                    :id="`sidebar-collapse-${index}`"
                                    accordion="main"
                                    class="sidebar-submenu"
                                >
                                    <ul>
                                        <template v-for="(child, cindex) in item.children">
                                            <li :key="cindex" v-if="child.to">
                                                <router-link :to="child.to">{{ child.text }}</router-link>
                                            </li>
                                        </template>
                                    </ul>
                                </b-collapse>
                            </template>
                        </li>
                    </template>
                </ul>
            </div>
            <!-- sidebar-menu  -->
        </VuePerfectScrollbar>
        <!-- sidebar-footer  -->
        <div class="sidebar-footer">
            <div v-for="(item, index) in footer" :key="index">
                <a @click.prevent="onClickFooterItem($event, item)">
                    <i :class="item.icon"></i>
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapState } from 'vuex'

import '@/assets/scss/sidebar/main.scss'

export default {
    name: 'MainSidebar',
    data() {
        return {
            settings: {
                wheelSpeed: .6
            },
            footer: [
                {
                    icon: 'mdi mdi-settings',
                    to: '/admin/settings'
                },
                {
                    icon: 'mdi mdi-logout-variant',
                    action: 'store.auth/logout'
                }
            ]
        }
    },
    computed: {
        ...mapState({
            items: state => state.layout.sidebar.items || [],
            role_id: state => state.auth.user.role_id || 0
        })
    },
    mounted() {
        let items = [
            {
                header: true,
                text: 'General'
            },
            {
                text: 'Dashboard',
                icon: 'mdi mdi-18px mdi-desktop-mac-dashboard',
                to: { name: 'Dashboard' }
            },
            {
                header: true,
                text: 'Users'
            },
            {
                text: 'Profiles',
                icon: 'mdi mdi-18px mdi-account',
                to: { name: 'UserProfileList' }
            },
            {
                header: true,
                text: 'Products Management'
            },
            {
                text: 'Products',
                icon: 'mdi mdi-18px mdi-shopping',
                to: { name: 'ProductList' }
            },
            {
                text: 'Category',
                icon: 'mdi mdi-18px mdi-format-list-bulleted-type',
                to: { name: 'CategoryList' }
            },
            {
                text: 'Brand',
                icon: 'mdi mdi-18px mdi-monitor-dashboard',
                to: { name: 'BrandList' }
            },
            {
                text: 'Skus',
                icon: 'mdi mdi-18px mdi-palette',
                to: { name: 'SkusList' }
            },
            {
                text: 'Product Review',
                icon: 'mdi mdi-18px mdi-message-draw',
                to: { name: 'ProductReviewList' }
            },
            {
                text: 'Promotion',
                icon: 'mdi mdi-18px mdi-sale',
                to: { name: 'PromotionList' }
            },
            {
                text: 'Vouchers ',
                icon: 'mdi mdi-18px mdi-ticket-percent',
                to: { name: 'UserPromotionList' }
            },
            {
                header: true,
                text: 'Products Management'
            },
            {
                text: 'Orders',
                icon: 'mdi mdi-18px mdi-truck',
                to: { name: 'OrderList' }
            },
            {
                text: 'Order Products',
                icon: 'mdi mdi-18px mdi-ferry',
                to: { name: 'OrderProductList' }
            },
            // {
            //     header: true,
            //     text: 'User Activities'
            // },
            // {
            //     header: true,
            //     text: 'Order Management'
            // },
            // {
            //     text: 'Orders',
            //     icon: 'mdi mdi-18px mdi-shopping',
            //     to: { name: 'OrderList' }
            // },
        ]
        if (this.role_id == 1) {
            items = items.concat([
                {
                    header: true,
                    text: 'System'
                },
                {
                    text: 'Users',
                    icon: 'mdi mdi-18px mdi-account-multiple',
                    to: '/admin/users'
                },
                {
                    text: 'Roles',
                    icon: 'mdi mdi-18px mdi-shield-account',
                    to: '/admin/roles'
                },
                // {
                //     text: 'Logs',
                //     icon: 'mdi mdi-18px mdi-file-document-box',
                //     to: '/admin/users/log-actions'
                // },
                // {
                //     text: 'Queues',
                //     icon: 'mdi mdi-18px mdi-clock-outline',
                //     to: '/admin/queues'
                // },
            ])
        }

        this.$store.dispatch('layout/setSidebarItems', items)
    },
    methods: {
        itemClass(item) {
            return {
                'header-menu': item.header,
                'sidebar-dropdown':
                    item.children && item.children.filter(c => c.to).length
            }
        },
        onClickFooterItem(e, item) {
            if (item.action) {
                if (item.action.substr(0, 6) === 'store.') {
                    let action = item.action.substr(6)
                    if (action && this.$store._actions[action]) {
                        this.$store.dispatch(action)
                    }
                }
            } else if (item.to) {
                this.$router.push(item.to)
            }
        },
    }
}
</script>

<style lang="scss">
.sidebar-wrapper {
    .sidebar-menu .sidebar-dropdown > a {
        &:after {
            transform: rotate(90deg);
        }
        &.collapsed:after {
            transform: rotate(0deg);
        }
    }
    .ps .ps__rail-x.ps--clicking, .ps .ps__rail-x:focus, .ps .ps__rail-x:hover, .ps .ps__rail-y.ps--clicking, .ps .ps__rail-y:focus, .ps .ps__rail-y:hover {
        background-color: transparent !important;
        opacity: .9;
    }
}
</style>
