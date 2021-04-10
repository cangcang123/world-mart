import store from '@/store'
import geo from "@/services/geo"

export default [
    {
        key: 'id',
        readonly: true,
        sortable: true
    },
    {
        label: 'Image',
        key: 'image_url',
        type: 'image_multi'
    },
    {
        label: 'Cover',
        key: 'cover_photo',
        type: 'image'
    },
    {
        label: 'Tên sản phẩm',
        key: 'name',
        sortable: true
    },
    {
        label: 'Thông tin chi tiết',
        key: 'description',
    },
    {
        label: 'Mô tả sản phẩm',
        key: 'sub_description',
    },
    {
        label: 'Hỏi đáp',
        key: 'question_answer',
    },
    {
        label: 'Giá sản phẩm',
        key: 'price',
        type:'number',
        sortable: true
    },
    {
        label: 'Tiền tệ',
        key: 'currency',
        sortable: true
    },
    {
        label: 'Giảm giá (%)',
        key: 'discount',
        type:'number',
        sortable: true
    },
    {
        label: 'Số lượng',
        key: 'quota',
        type:'number',
        sortable: true
    },
    {
        label: 'Hoa Hồng (%)/Sản phẩm',
        key: 'bonus_rating',
        type:'number',
        sortable: true
    },
    {
        label: 'Hoa Hồng người giới thiệu',
        key: 'bonus_referral',
        type:'number',
        sortable: true
    },
    {
        label: 'Short Title',
        key: 'meta_title',
    },
    {
        label: 'Short Content',
        key: 'meta_content',
    },
    {
        label: 'Hướng dẫn sử dụng',
        key: 'usage',
    },
    {
        label: 'Xuất xứ',
        key: 'origin',
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.countries.length) {
                await store.dispatch('crm/getCountries')
            }
            return geo.geoToSelectCountry(store.state.crm.countries)
        }
    },
    {
        key: "category",
        label: "Category",
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.category.length) {
                await store.dispatch('crm/getCategories')
            }
            return store.state.crm.category.map(p => ({ text: p.name, value: p.id }))
        },
    },
    {
        key: "brand",
        label: "Nhãn hàng",
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.brand.length) {
                await store.dispatch('crm/getBrands')
            }
            return store.state.crm.brand.map(p => ({ text: p.name, value: p.id }))
        },
    },
    {
        label: "Promotion",
        key: "promotion",
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.promotion.length) {
                await store.dispatch('crm/getPromotions')
            }
            return store.state.crm.promotion.map(p => ({ text: p.name, value: p.id }))
        },
    },
    {
        label: 'Slug',
        key: 'slug',
        readonly: true,
        sortable: true
    },
    {
        label: 'Total Like',
        key: 'total_like',
        readonly: true,
        sortable: true,
    },
    {
        label: 'Top Product',
        key: 'is_hot',
        type: 'select',
        sortable: true,
        options: [
            { value: 1, text: 'On'},
            { value: 2, text: 'Off'}
        ],
    },
    {
        label: 'New Product',
        key: 'is_new',
        type: 'select',
        sortable: true,
        options: [
            { value: 1, text: 'Yes'},
            { value: 2, text: 'No'}
        ],
    },
    {
        label: 'Best Selling',
        key: 'best_seller',
        type: 'select',
        sortable: true,
        options: [
            { value: 1, text: 'Yes'},
            { value: 2, text: 'No'}
        ],
    },
    {
        label: 'High Profit',
        key: 'is_profit',
        type: 'select',
        sortable: true,
        options: [
            { value: 1, text: 'Yes'},
            { value: 2, text: 'No'}
        ],
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        sortable: true,
        options: [
            { value: 1, text: 'On'},
            { value: 2, text: 'Off'}
        ],
    },
    {
        label: 'Created Date',
        key: 'created_at',
        sortable: true,
        readonly: true,
    }
]