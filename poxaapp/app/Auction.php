<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Auction
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\bidingHistories[] $bidingHistories
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property float|null $price_inc
 * @property int|null $time_inc
 * @property int|null $min_real_bids
 * @property int|null $autobid_limit
 * @property int|null $auction_status 1:Live
 * @property int|null $status 0:De-active; 1:Active
 * @property int|null $is_sold 1:solded
 * @property int|null $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_expired 0:Expired; 1:Not Expired
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereAuctionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereAutobidLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereIsExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereIsSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereMinRealBids($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction wherePriceInc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereTimeInc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auction whereUpdatedAt($value)
 */
class Auction extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function bidingHistories()
    {
        return $this->hasMany('App\bidingHistories');
    }
}
