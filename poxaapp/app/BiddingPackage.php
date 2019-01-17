<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BiddingPackage
 *
 * @property int $id
 * @property string $name
 * @property float|null $price
 * @property int $status 0:Inactive; 1:Active
 * @property int $is_delete 0:Deleted; 1:Not Deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $number_of_bids
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereNumberOfBids($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BiddingPackage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BiddingPackage extends Model
{
    //
}
