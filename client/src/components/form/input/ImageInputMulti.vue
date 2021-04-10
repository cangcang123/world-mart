<template>
    <div>
        <el-upload
            multiple
            :action="uploadUrl"
            :headers="headers"
            :limit="5"
            :on-success="handleSuccess"
            :on-error="handleError"
            :on-preview="handlePreview"
            :on-remove="handleRemove"
            :file-list="fileList"
            list-type="picture">
            <el-button size="small" type="primary">Click to upload</el-button>
            <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 500kb</div>
            </el-upload>
    </div>
</template>

<script>
import { buildURL } from '@/helpers/utils'

export default {
    name: 'ImageInput',
    props: {
        value: {
            type: Array,
            required: true,
        },
        imageField: {
            type: String,
            default: 'image'
        },
    },
    data() {
        return {
            fileList: this.value,
            imgs: []
        }
    },
    computed: {
        uploadUrl(file) {
            return buildURL(process.env.VUE_APP_API_URL, 'admin/upload/image-multi')
        },
        headers() {
            if (this.$store.state.auth.token) {
                return {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            }
            else return {}
        },
    },
    methods: {
        handleRemove(file, fileList) {
            this.$emit('input', fileList)
        },
        handlePreview(file) {
        },
        handleSuccess(res, file) {
            if (res.url) {
                this.value.push({
                    name: res.name,
                    url: res.url
                })
                this.$emit('input', this.value)
            } else {
                this.$bvToast.toast(res.message || 'Có lỗi khi upload hình ảnh', {
                    title: 'Lỗi',
                    variant: 'danger'
                })
            }
        },
        handleError(err) {
            try {
                let res = JSON.parse(err.message)
                if (res && res.validator && res.validator.image) {
                    if (res.validator.image.length) {
                        this.$bvToast.toast(res.validator.image[0], {
                            title: 'Lỗi',
                            variant: 'danger'
                        })
                    }
                }
            } catch (error) {
                this.$bvToast.toast('Có lỗi khi upload hình ảnh', {
                    title: 'Lỗi',
                    variant: 'danger'
                })
            }
        },
        beforeUpload(file) {
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            // return isJPG && isLt2M;
            return true;
        },
        selectFile() {
            if (this.$refs.uploader) {
                this.$refs.uploader.$refs["upload-inner"].$el.click()
            }
        },
        remove() {
            this.$emit('input', '')
        }
    },
    watch: {
        // imgs: {
        //     handler(val) {
        //         console.log(val , 1)
        //         this.$emit('input', val)
        //     },
        //     deep: true
        // },
    }
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
        transition: text-shadow .3s;
        &:hover {
            text-shadow: 1px 1px 2px #4d0000;
        }
    }
}

</style>
