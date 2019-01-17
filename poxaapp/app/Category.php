<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Category
 *
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $image
 * @property int|null $featured
 * @property int $status 0:Inactive; 1:Active
 * @property int $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 */
class Category extends Model
{
    

     /**
     * Get the phone record associated with the user.
     */
    public function product()
    {
        return $this->hasOne('App\Product');

    }
}
