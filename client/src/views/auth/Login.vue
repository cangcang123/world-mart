<template>
    <b-card class="vue-card" bg-variant="white" text-variant="dark" header="Sign In" >
        <div class="vue-tempalte">
            <b-form>
                <h3 class="text-center">Worldmart</h3>
                <div class="form-group">
                    <label>Username</label>
                    <input v-model="username" id="username" type="text" required class="form-control form-control-lg" />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input v-model="password" id="password" type="password" required class="form-control form-control-lg" />
                </div>
                <div>
                    <b-btn variant="dark" :disabled="loading" @click="login" class="login mt-2"><span></span><span>Sign in</span></b-btn>
                </div>
                <!-- <p class="forgot-password text-right mt-2 mb-4">
                    <router-link to="/forgot-password">Forgot password ?</router-link>
                </p> -->
            </b-form>
        </div>
    </b-card>
</template>

<script>
import Auth from '@/services/auth'

export default {
    data:() => ({
        loading: false,
        username: '',
        password: ''
    }),
    methods: {
        async login() {
            this.loading = true
            let res = await Auth.login(this.username, this.password).catch(() => {})
            this.loading = false

            if (res) {
                this.$store.commit('auth/TOKEN', res.access_token)
                this.$router.push(this.$route.query.redirect || '/user-profiles')
                this.$root.$bvToast.toast('Login Successful', {
                    title: 'Success',
                    variant: 'success'
                })
            } else {
                this.$bvToast.toast('Login Failed', {
                    title: 'Error',
                    variant: 'danger'
                })
            }
        }
    }
}
</script>

<style lang="scss">
.vue-card {
    width: 400px;
    height: 400px;
    margin: auto;
    background: #ffffff;
    box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
    border-radius: 15px;
    transition: all .3s;
    margin: 0 auto;
    padding: 5px;
    
    .login {
        margin: 36%;
        width: 110px;
        border: 1px solid green;
        border-radius: 15px;
        padding: 8px;
    }
}




</style>
