<template>
<div>
    <div class="bg"></div>
    <b-container fluid>
        <b-row class="vh-100">
            <b-col class="mx-auto my-auto" cols="12" md="10">
                <router-view></router-view>
            </b-col>
        </b-row>

    </b-container>
</div>
</template>

<script>
export default {
    data() {
        return {
            year: 2019
        }
    },
    mounted() {
        this.getYear()
    },
    methods: {
        getYear() {
            var day = new Date()
            this.year = day.getFullYear()
        }
    }
}
</script>

<style lang="scss" scoped>
.bg {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100%;
    background-attachment: fixed;
    background-color: #7a0c2d;
    background-image:linear-gradient(to top, rgba(255, 136, 0, 0.5), rgba(73, 73, 104, 0.322)),
            url("../assets/img/shopping.jpg");
}
</style>
