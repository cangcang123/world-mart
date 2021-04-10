<template>
    <div>
        <b-modal ref="modal" hide-header-close no-close-on-esc no-close-on-backdrop id="modal-sm modal-center" size="sm" title="Small Modal" centered hide-footer>
            <template v-slot:modal-title >
                <span class="d-block text-center">Exporting File</span>
            </template>
        <span class="d-block text-center">
            <countdown :leftTime="time">
                <h1
                slot="process"
                slot-scope="{ timeObj }">
                    {{ timeObj.ceil.s }}
                </h1>
                <span slot="finish">
                    <b-button class="mt-2" variant="danger" block @click="closeModal">Stay in page</b-button>
                    <b-button class="mt-2" variant="success" block :to="{name: 'ListExportFiles'}">Go to List Files</b-button>
                </span>
            </countdown>
        </span>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: 'CountDown',
    props: {
        modalShow: {
            type: Boolean,
            default: false
        },
        leftTime: {
            type: Number,
            default: 5000
        },
        link: {
            type: String
        }
    },
    data() {
        return {
            time: this.leftTime,
        }
    },
    methods: {
        redirect() {
            this.$router.push(this.link)
        },
        closeModal() {
            this.$emit("update:modalShow", false);
            this.$refs.modal.hide()
        },
        show() {
            this.$refs.modal.show()
        },
    },
    watch: {
        modalShow(val) {
            if(val) {
                this.show()
            }
        }
    }
}
</script>
