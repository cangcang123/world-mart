<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use SHOP\Admin\Models\Country;
use SHOP\CRM\Models\ProductReview;
use App\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'product';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'id',
        'name',
        'title',
        'meta_title',
        'meta_content',
        'description',
        'sub_description',
        'usage',
        'cover_photo',
        'image_url',
        'price',
        // 'size',
        'currency',
        'category',
        'brand',
        'slug',
        'rating',
        // 'color',
        'quota',
        // 'sku',
        // 'memory',
        // 'weight',
        'promotion',
        'discount',
        'origin',
        'bonus_rating',
        'bonus_referral',
        'total_like',
        'tags',
        'product_label',
        'is_hot',
        'is_new',
        'is_profit',
        'best_seller',
        'relate_product',
        'question_answer',
        'status',
        'deleted',
        'status_log',
    ];

    protected $with = [
        'productCategory',
        // 'productColor',
        // 'productSize',
        'productBrand',
        'productOrigin',
        'productDiscount',
        // 'brand'
    ];

    public function productCategory(){
        return $this->hasOne(Category::class,'id','category');
    }

    public function productDiscount(){
        return $this->hasOne(Promotion::class,'id','promotion');
    }

    // public function productColor(){
    //     return $this->hasOne(Color::class,'id','color');
    // }

    // public function productSize(){
    //     return $this->hasOne(Size::class,'id','size');
    // }

    public function productBrand(){
        return $this->hasOne(Brand::class,'id','brand');
    }

    public function productOrigin(){
        return $this->hasOne(Country::class,'iso','origin');
    }

    public function getProductRatingAttribute() {
        $rating = ProductReview::where(['status' => 1, 'product_id' => $this->id])->select('rating')->get()->toArray();
        if(count($rating) > 0){
            $this->rating = round(array_sum(array_column($rating,'star'))/count($rating));
        }else{
            $this->rating = 0;
            return 0;
        }
        return $this->rating;
    }

    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class, 'brand');
    // }

}
