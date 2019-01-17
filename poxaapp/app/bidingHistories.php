<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\bidingHistories
 *
 * @property-read \App\Auction $auction
 * @property-read \App\Product $product
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property int $auction_id
 * @property int $user_id
 * @property string|null $username
 * @property float $price
 * @property int|null $is_winner 1:winner
 * @property int|null $bid_type 0:Auto Bid; 1:Bid
 * @property int|null $status 0:De-active; 1:Active
 * @property int|null $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereAuctionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereBidType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereIsWinner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\bidingHistories whereUsername($value)
 */
class bidingHistories extends Model
{
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function auction(){
        
        return $this->belongsTo('App\Auction');
       
    }
    
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
