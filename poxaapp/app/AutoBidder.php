<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AutoBidder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int|null $status 0:De-active; 1:Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AutoBidder whereUpdatedAt($value)
 */
class AutoBidder extends Model
{
    //
}
