<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Product
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Auction[] $auctions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\bidingHistories[] $bidingHistories
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductImage[] $productImages
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $product_name
 * @property string|null $slug
 * @property string|null $product_code
 * @property string|null $description
 * @property float $price
 * @property int|null $winer_user_id winner user id
 * @property float|null $buy_now_price
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property int|null $status 0:De-active; 1:Active
 * @property int|null $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product findByCategoryId($category_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBuyNowPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereWinerUserId($value)
 */
class Product extends Model {
    //

    /**
     * Get the Product Image for the Product.
     */
    public function productImages() {
        return $this->hasMany('App\ProductImage');
    }

    /**
     * Get the Product Image for the Product.
     */
    public function productLatestImages() {
        return $this->hasOne('App\ProductImage')->latest('created_at');
    }


    /**
     * Get the auction for the Product.
     */
    public function auctions() {
        return $this->hasMany('App\Auction');
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function bidingHistories()
    {
        return $this->hasMany('App\bidingHistories');
    }

    /*
     * Get the Product by the category
     */
    public function scopeFindByCategoryId($query, $category_id){

        return $query->where('category_id', $category_id)
            ->with([
                'productLatestImages'
            ]);
    }



}
