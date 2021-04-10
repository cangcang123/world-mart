<template>
<h4 class="header py-3">
    <slot>{{ header }}</slot>
    <div class="float-right"><slot name="actions"></slot></div>
</h4>
</template>

<script>
export default {
    name: 'PageHeader',
    props: {
        header: {
            type: String
        }
    }
}
</script>
