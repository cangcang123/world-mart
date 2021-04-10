

import store from '@/store'

export default [
    {
        key: 'id',
        readonly: true
    },
    {
        label: 'Thumbnail',
        key: 'thumbnail',
    },
    {
        label: 'Tên sản phẩm',
        key: 'name',
    },
    {
        label: 'Mã sản phẩm (SKU)',
        key: 'sku',
    },
    {
        label: 'Product',
        key: 'product_id',
        type: 'select',
        readonly: true,
        sortable: true,
        options: async () => {
            if (!store.state.crm.products.length) {
                await store.dispatch('crm/getProducts')
            }
            return store.state.crm.products.map(o => ({ text: o.name, value: o._id}))
        }
    },
    {
        label: 'Nội dung',
        key: 'description',
        type: 'text',

    },
    {
        label:'Trọng lượng (Nếu có)',
        key: 'weight',
    },
    {
        label:'Dung lượng bộ nhớ (Nếu có)',
        key: 'memory',
    },
    {
        label: 'Kích thước (Nếu có)',
        key: 'size',
    },
    {
        label:'Màu sắc (Nếu có)',
        key: 'color',
    },
    {
        label: 'Price',
        key: 'price',
        type:'number',
        sortable: true
    },
    {
        label: 'Số lượng',
        key: 'quantity',
        type:'number',
        sortable: true
    },
    {
        label: 'Used Time',
        key: 'used_time',
        type:'number',
        sortable: true
    },
    {
        label: 'Status',
        type: 'select',
        key:'status',
        options:[
            { value: 1, text: 'Active' },
            { value: 2, text: 'Deactivated' },
        ]
    },
]