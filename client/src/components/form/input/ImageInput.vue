<template>
    <div class="image-input">
        <el-upload
            class="image-input-uploader"
            ref="uploader"
            :name="imageField"
            :disabled="disabled"
            :action="uploadUrl"
            :headers="headers"
            :multiple="multiple"
            :limit="limit"
            :show-file-list="false"
            :on-success="handleSuccess"
            :on-error="handleError"
            :before-upload="beforeUpload"
        >
            <b-img
                v-if="imageUrl"
                :width="400"
                :src="imageUrl"
                class="avatar"
                thumbnail
                fluid
                :alt="imageUrl"
            ></b-img>
            <b-button
                v-else
                size="sm"
                class="mdi mdi-upload"
                variant="outline-primary"
            >
                Upload image</b-button
            >
        </el-upload>
        <span
            v-if="imageUrl && !disabled"
            @click="remove"
            class="remove-image mdi mdi-close-circle"
        ></span>
    </div>
</template>

<script>
import { buildURL } from '@/helpers/utils'

export default {
    name: 'ImageInput',
    props: {
        multiple: {
            type: Boolean,
            required: false,
            default: false,
        },
        limit: {
            type: Number,
            required: false,
            default: 1,
        },
        value: {
            type: String,
            required: false,
        },
        imageField: {
            type: String,
            default: 'image',
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            imageUrl: this.value,
        }
    },
    computed: {
        uploadUrl() {
            return buildURL(process.env.VUE_APP_API_URL, 'admin/upload/image')
        },
        headers() {
            if (this.$store.state.auth.token) {
                return {
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
                }
            } else return {}
        },
    },
    methods: {
        handleSuccess(res, file) {
            if (res.url) {
                this.imageUrl = res.url
                this.$emit('input', res.url)
            } else {
                this.$bvToast.toast(
                    res.message || 'Có lỗi khi upload hình ảnh',
                    {
                        title: 'Lỗi',
                        variant: 'danger',
                    },
                )
            }
        },
        handleError(err) {
            try {
                let res = JSON.parse(err.message)
                if (res && res.validator && res.validator.image) {
                    if (res.validator.image.length) {
                        this.$bvToast.toast(res.validator.image[0], {
                            title: 'Lỗi',
                            variant: 'danger',
                        })
                    }
                }
            } catch (error) {
                this.$bvToast.toast('Có lỗi khi upload hình ảnh', {
                    title: 'Lỗi',
                    variant: 'danger',
                })
            }
        },
        beforeUpload(file) {
            const isJPG = file.type === 'image/jpeg'
            const isLt2M = file.size / 1024 / 1024 < 2

            // return isJPG && isLt2M;
            return true
        },
        selectFile() {
            if (this.$refs.uploader) {
                this.$refs.uploader.$refs['upload-inner'].$el.click()
            }
        },
        remove() {
            this.$emit('input', '')
        },
    },
    watch: {
        value(val) {
            this.imageUrl = val
        },
    },
}
</script>

<style lang="scss">
.image-input {
    position: relative;
    max-width: 500px;

    .remove-image {
        position: absolute;
        top: -13px;
        left: -13px;
        font-size: 26px;
        color: #ff4f4f;
        cursor: pointer;
        transition: text-shadow 0.3s;
        &:hover {
            text-shadow: 1px 1px 2px #4d0000;
        }
    }
}
</style>
