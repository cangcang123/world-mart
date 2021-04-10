<template>
    <vs-popup title="Informations" :active.sync="visible">
        <div class="bg-white p-3">
            <b-container fluid>
                <b-row>
                    <vs-button color="danger" type="line" icon="vpn_key" @click="popup_change_pass=true;popup_info=false">Change Password</vs-button>
                </b-row>
                <b-row>
                    <vs-button color="dark" type="line" icon="exit_to_app" @click="logout()">Logout</vs-button>
                </b-row>
            </b-container>
        </div>

        <vs-popup title="Change Password" :active.sync="popup_change_pass" v-loading="loading">
            <div class="bg-white p-3">
                <b-form class="submit-form">
                    <b-form-group label="Current password">
                        <b-input-group>
                            <b-form-input
                                id="current_password_input"
                                name="current_password_input"
                                placeholder="Current password"
                                v-model="$v.form.current_password.$model"
                                :state="$v.form.current_password.$dirty ? !$v.form.current_password.$error : null"
                                autocomplete="new-password"
                                type="password"
                            ></b-form-input>

                            <b-form-invalid-feedback id="input_current_password_feedback">
                                <div v-if="!$v.form.current_password.required">
                                    Vui lòng nhập mật khẩu
                                </div>
                            </b-form-invalid-feedback>
                        </b-input-group>
                    </b-form-group>

                    <b-form-group label="Password">
                        <b-input-group>
                            <b-form-input
                                id="new_password_input"
                                name="new_password_input"
                                placeholder="New password"
                                v-model="$v.form.new_password.$model"
                                :state="$v.form.new_password.$dirty ? !$v.form.new_password.$error : null"
                                autocomplete="new-password"
                                :type.sync="pass_field_type"
                            ></b-form-input>
                            <b-input-group-append>
                                <b-button variant="success" @click="onGenPass">Gen</b-button>
                                <b-button variant="secondary"
                                    v-clipboard:copy="form.new_password"
                                    v-clipboard:success="onCopy"
                                >Copy</b-button>
                                <b-button variant="primary" @click="toggleVisibilityPass">Show</b-button>
                            </b-input-group-append>

                            <b-form-invalid-feedback id="input_new_password_feedback">
                                <div v-if="!$v.form.new_password.required">
                                    Vui lòng nhập mật khẩu
                                </div>
                                <div v-else-if="!$v.form.new_password.strongPassword">
                                    Mật khẩu phải có ít nhất 10 ký tự bao gồm chữ hoa, chữ thường, số & ký tự đặc biệt
                                </div>
                            </b-form-invalid-feedback>
                        </b-input-group>
                    </b-form-group>


                    <b-form-group label="Re-password">
                        <b-form-input
                            required
                            placeholder="Re-password"
                            id="re_new_password_input"
                            name="re_new_password_input"
                            v-model="$v.form.re_new_password.$model"
                            :state="$v.form.re_new_password.$dirty ? !$v.form.re_new_password.$error : null"
                            autocomplete="new-password"
                            type="password"
                        ></b-form-input>

                        <b-form-invalid-feedback id="input_re_new_password_feedback">
                            <div v-if="!$v.form.re_new_password.required">
                                Vui lòng nhập lại mật khẩu
                            </div>
                            <div v-else-if="!$v.form.re_new_password.sameAsPassword">
                                Mật khẩu chưa trùng khớp
                            </div>
                            <div v-else-if="!$v.form.re_new_password.strongPassword">
                                Mật khẩu phải có ít nhất 10 ký tự bao gồm chữ hoa, chữ thường, số & ký tự đặc biệt
                            </div>
                        </b-form-invalid-feedback>
                    </b-form-group>
                </b-form>
                <b-form-group class="submit-form">
                    <vs-button color="success" type="line" icon="save" @click="updatePassword">Save</vs-button>
                    <vs-button color="warning" type="line" icon="cancel" @click="popup_info=true;popup_change_pass=false">Cancel</vs-button>
                </b-form-group>
            </div>
        </vs-popup>
    </vs-popup>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, sameAs  } from 'vuelidate/lib/validators'
import axios from 'axios'
import CURD from "@/services/curd"
import { buildURL } from "@/helpers/utils"
import { mapState } from 'vuex'
import passGenerator from 'generate-password'

export default {
    props: ["show"],
    mixins: [validationMixin],
    data() {
        return {
            popup_change_pass: false,
            pass_field_type: 'password',
            form: {
                current_password: '',
                new_password: '',
                re_new_password: ''
            },
            loading: false,
            entry: 'admin/users'
        }
    },
    computed: {
        ...mapState({
            user_id: state => state.auth.user.id,
        }),
        visible: {
            get() {
                return this.show
            },
            set(value) {
                this.$emit("update:show", value)
            },
        },
    },
    validations: {
        form: {
            current_password: {
                required
            },
            new_password: {
                required,
                strongPassword(new_password) {
                    return (
                        /[a-z]/.test(new_password) && // checks for a-z
                        /[A-Z]/.test(new_password) &&
                        /[0-9]/.test(new_password) && // checks for 0-9
                        /\W|_/.test(new_password) && // checks for special char
                        new_password.length >= 10
                    );
                }
            },
            re_new_password: {
                required,
                sameAsPassword: sameAs("new_password"),
                strongPassword(re_new_password) {
                    return (
                        /[a-z]/.test(re_new_password) && // checks for a-z
                        /[A-Z]/.test(re_new_password) &&
                        /[0-9]/.test(re_new_password) && // checks for 0-9
                        /\W|_/.test(re_new_password) && // checks for special char
                        re_new_password.length >= 10
                    );
                }
            }
        }

    },
    methods: {
        async updatePassword() {
            this.$v.$touch()
            let has_errors = this.$v.$anyError;

            if(!has_errors) {
                try {
                    this.loading = true
                    let res = await axios.post(buildURL(process.env.VUE_APP_API_URL, this.entry, 'change-pass'), {
                        uid: this.user_id,
                        current_password: this.form.current_password,
                        new_password: this.form.new_password
                    })

                    if(res.data.success) {
                        this.$bvToast.toast(res.data.message || 'Đã đổi mật khẩu', {
                            title: 'Thành công',
                            variant: 'success'
                        })
                        this.resetForm()
                    } else {
                        this.$bvToast.toast(res.data.message || 'Đổi mật khẩu không thành công', {
                            title: 'Không thành công',
                            variant: 'danger'
                        })
                    }

                } catch (error) {
                    this.$bvToast.toast(error.response.data.message || error.message, {
                        title: 'Lỗi',
                        variant: 'danger'
                    })
                }

                this.loading = false
                this.$emit("update:show", false)
                this.popup_change_pass = false
            }
        },

        toggleVisibilityPass() {
            this.pass_field_type = this.pass_field_type == 'password' ? 'text' : 'password'
        },

        onGenPass() {
            const pass = passGenerator.generate({
                length: 10,
                numbers: true,
                symbols: true,
                excludeSimilarCharacters: true,
                uppercase: true,
                strict: true,
            })

            this.form.new_password = pass
            // this.form.re_new_password = pass
        },

        onCopy(e) {
            this.$bvToast.toast('Copied!', {
                title: 'Copied!',
                variant: 'success'
            })
        },

        resetForm() {
            this.form.current_password = ''
            this.form.new_password = ''
            this.form.re_new_password = ''
            this.$v.$reset()
        },

        async logout() {
            this.$emit("logout")
        }
    },
}
</script>



<style lang="scss">
    .b-toaster {
        z-index: 10000;
    }
</style>