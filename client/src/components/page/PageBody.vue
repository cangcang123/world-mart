<script>
export default {
    name: 'PageBody',
    functional: true,
    render(h, context) {
        return h('div', { class: ['bg-white shadow rounded', context.data.class, context.data.staticClass] }, context.slots().default)
    },
}
</script>
