<template>
<b-card class="auth-card">
    <b-row class="mb-5 text-center">
        <b-col>
            <h5>Shopping CRM</h5>
        </b-col>
    </b-row>
    <b-row>
        <b-col cols="12">
            <b-form>
                <b-form-group class="has-float-label" :label="$t('login.username')" label-for="username">
                    <b-form-input v-model="username" id="username" type="text" required></b-form-input>
                </b-form-group>
                <b-form-group class="has-float-label" :label="$t('login.password')" label-for="username">
                    <b-form-input v-model="password" id="password" type="password" required></b-form-input>
                </b-form-group>
                <b-row>
                    <b-col>
                        <b-btn variant="success" :disabled="loading" @click="login" class="btn-login"><span v-if="loading" class="mdi mdi-loading mdi-spin"></span><span class="mdi mdi-login-variant"></span> {{ $t('login.login') }}</b-btn>
                    </b-col>
                </b-row>
            </b-form>
        </b-col>
    </b-row>
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
.auth-card {
    color: #02b61a;
    max-width: 500px;
    margin: 0 auto;
    padding: 40px 20px;
    border: 1px solid #bdbdbd;

    .has-float-label {
        input {
            font-size: 12px;
            height: 34px;
        }
    }

    .btn-login {
        font-size: 12px;
    }

    .locale-changer {
        font-size: 12px;
    }

    .cover-text {
        font-size: 25px;
        margin-left: 170px;
        color: #0e0c7a;
        font-weight: bold;
    }
}
</style>
