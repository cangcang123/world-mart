import UserProfile from './user-profile'
import Color from './color'
import CRMConfig from './config'
import UserTag from './user-tag'
import Category from './category'
// import Notification from './notification'
import Order from './order'
import OrderProduct from './order-product'
// import Cart from './cart'
// import Transaction from './transaction'
// import UserReview from './user-review'
import ProductReview from './product-review'
import Product from './product'
import Sku from './skus'
import Promotion from './promotion'
import Voucher from './voucher'
import Brand from './brand'
import Size from './size'

export default [
    ...Order,
    ...OrderProduct,
    ...UserProfile,
    ...Color,
    ...Voucher,
    ...Category,
    ...Sku,
    // ...Notification,
    // ...Cart,
    // ...Transaction,
    // ...UserReview,
    ...ProductReview,
    ...Product,
    ...Promotion,
    ...Brand,
    ...Size,
    ...CRMConfig,
    ...UserTag,
]
