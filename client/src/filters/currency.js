export default function Currency(value) {
    if (typeof value != 'string') {
        value = value.toString()
    }
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
