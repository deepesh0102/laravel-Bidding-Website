<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\ProductImage
 *
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property string $image_name
 * @property int|null $status 0:De-active; 1:Active
 * @property int|null $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereUpdatedAt($value)
 */
class ProductImage extends Model
{
    //
    
    
    
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    
    
    
    
}
