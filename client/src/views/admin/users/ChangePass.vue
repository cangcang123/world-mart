<template>
<page>
    <page-header>Đổi mật khẩu</page-header>

    <div v-if="item">
        <input-field :value="item.full_name" :field="{ readonly: true, label: 'Full Name' }"></input-field>
        <input-field :value="item.username" :field="{ readonly: true, label: 'Username' }"></input-field>

        <b-form-group label="Mật khẩu Admin">
            <b-form-input
                id="admin_password_input"
                name="admin_password_input"
                v-model="$v.admin_password.$model"
                :state="$v.admin_password.$dirty ? !$v.admin_password.$error : null"
                type="password"
                autocomplete="new-password"
            ></b-form-input>

            <b-form-invalid-feedback id="input_admin_password_feedback">
                <div v-if="!$v.admin_password.required">
                    Vui lòng nhập mật khẩu
                </div>
            </b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Mật khẩu mới">
            <b-form-input
                id="new_password_input"
                name="new_password_input"
                v-model="$v.new_password.$model"
                :state="$v.new_password.$dirty ? !$v.new_password.$error : null"
                type="password"
                autocomplete="new-password"
            ></b-form-input>

            <b-form-invalid-feedback id="input_new_password_feedback">
                <div v-if="!$v.new_password.required">
                    Vui lòng nhập mật khẩu
                </div>
                <div v-else-if="!$v.new_password.strongPassword">
                    Mật khẩu phải có ít nhất 10 ký tự bao gồm chữ hoa, chữ thường, số & ký tự đặc biệt
                </div>
            </b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Nhập lại mật khẩu mới">
            <b-form-input
                id="re_new_password_input"
                name="re_new_password_input"
                v-model="$v.re_new_password.$model"
                :state="$v.re_new_password.$dirty ? !$v.re_new_password.$error : null"
                type="password"
                autocomplete="new-password"
            ></b-form-input>

            <b-form-invalid-feedback id="input_re_new_password_feedback">
                <div v-if="!$v.re_new_password.required">
                    Vui lòng nhập lại mật khẩu
                </div>
                <div v-else-if="!$v.re_new_password.sameAsPassword">
                    Mật khẩu chưa trùng khớp
                </div>
                <div v-else-if="!$v.re_new_password.strongPassword">
                    Mật khẩu phải có ít nhất 10 ký tự bao gồm chữ hoa, chữ thường, số & ký tự đặc biệt
                </div>
            </b-form-invalid-feedback>
        </b-form-group>

        <b-button @click="updatePassword">Đổi mật khẩu</b-button>
    </div>
</page>
</template>

<script>
import Edit from '@/mixins/edit'
import axios from 'axios'
import { validationMixin } from 'vuelidate'
import { required, sameAs  } from 'vuelidate/lib/validators'

export default {
    name: 'AdminUserChangePass',
    mixins: [Edit, validationMixin],
    data() {
        return {
            admin_password: '',
            new_password: '',
            re_new_password: '',
            entry: 'admin/users'
        }
    },
    validations: {
        admin_password: {
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
    },
    mounted() {
        this.getData()
    },
    methods: {
        afterGotData(item) {
            if (!item) {
                this.$bvToast.toast('User không tồn tại', {
                    title: 'Lỗi',
                    variant: 'danger'
                })
                this.$router.back()
            }
        },
        async updatePassword() {
            const unloading = this.$loading({
                target: '.page-container'
            })

            let has_errors = this.$v.$anyError;

            if(!has_errors) {
                await axios.post(this.$service.buildURL('reset-pass'), {
                    admin_uid: this.admin_uid,
                    uid: this.id,
                    admin_password: this.admin_password,
                    new_password: this.new_password
                })
                .then(res => {
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
                })
                .catch(err => {
                    this.$bvToast.toast(err.response.data.message || err.message, {
                        title: 'Lỗi',
                        variant: 'danger'
                    })
                })
            }

            unloading.close()
        },
        resetForm() {
            this.admin_password = ''
            this.new_password = ''
            this.re_new_password = ''
            this.$v.$reset()
        }
    },
    watch: {
        id() {
            this.getData()
        }
    }
}
</script>