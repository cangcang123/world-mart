<template>
    <div class="image-input image-input-multiple">
        <el-upload
            class="image-input-uploader"
            ref="uploader"
            multiple
            :name="imageField"
            :disabled="disabled"
            :action="uploadUrl"
            :headers="headers"
            :limit="limit"
            :show-file-list="false"
            :on-success="handleSuccess"
            :on-error="handleError"
            :before-upload="beforeUpload"
        >
            <div class="image-container" v-if="imageUrl.length > 0">
                <div
                    class="relative mt-3 image-item"
                    :key="idx"
                    v-for="(url, idx) in imageUrl"
                >
                    <b-img
                        :width="250"
                        :key="'img-' + idx"
                        :src="url"
                        class="avatar"
                        thumbnail
                        fluid
                        :alt="url"
                    ></b-img>
                    <span
                        :key="'remove-' + idx"
                        v-if="!disabled"
                        @click="remove(idx, $event)"
                        class="remove-image mdi mdi-close-circle"
                    ></span>
                </div>
            </div>
            <b-button
                size="sm"
                v-if="imageUrl.length < limit"
                class="mdi mdi-upload mt-1 d-inline-block"
                variant="outline-primary"
            >
                Upload image</b-button
            >
        </el-upload>
    </div>
</template>

<script>
import { buildURL } from '@/helpers/utils'

export default {
    name: 'ImageMulti',
    props: {
        limit: {
            type: Number,
            required: false,
            default: 1,
        },
        value: {
            type: Array | null,
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
                this.imageUrl.push(res.url)
                this.$emit('input', this.imageUrl)
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
        remove(idx, event) {
            event.stopPropagation()

            this.imageUrl.splice(idx, 1)
            this.$emit('input', this.imageUrl)
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
.image-input-multiple {
    position: relative;
    .image-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;

        .image-item {
            max-width: 200px;
            min-width: 150px;
            padding: 10px;
            .remove-image {
                position: absolute;
                top: -5px;
                left: -5px;
                font-size: 26px;
                color: #ff4f4f;
                cursor: pointer;
                transition: text-shadow 0.3s;
                &:hover {
                    text-shadow: 1px 1px 2px #4d0000;
                }
            }
        }
    }
}

.relative {
    position: relative;
}
</style>
