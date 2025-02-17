<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Listing|null $listing
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\OfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer query()
 * @property int $id
 * @property int $user_id
 * @property int $listing_id
 * @property int $amount
 * @property string|null $accepted_at
 * @property string|null $rejected_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer byMe()
 * @mixin \Eloquent
 */
class Offer extends Model {
	/** @use HasFactory<\Database\Factories\OfferFactory> */
	use HasFactory;
	protected $fillable = [ 
		'user_id',
		'listing_id',
		'amount',
		'accepted_at',
		'rejected_at',
	];
	public function user(): BelongsTo {
		return $this->belongsTo( User::class);
	}
	public function listing(): BelongsTo {
		return $this->belongsTo( Listing::class);
	}
	public function scopeByMe( Builder $query ) {
		return $query->where( 'user_id', auth()->id() );
	}
}
