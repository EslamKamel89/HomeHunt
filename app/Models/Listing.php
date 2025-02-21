<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

/**
 * 
 *
 * @property int $id
 * @property int $beds
 * @property int $baths
 * @property int $area
 * @property string $code
 * @property string $city
 * @property string $street
 * @property string $street_nr
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ListingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereBaths($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereBeds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereStreetNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereUserId($value)
 * @method static Builder<static>|Listing filter(array $filters)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder<static>|Listing onlyTrashed()
 * @method static Builder<static>|Listing whereDeletedAt($value)
 * @method static Builder<static>|Listing withTrashed()
 * @method static Builder<static>|Listing withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListingImage> $listingImages
 * @property-read int|null $listing_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offer> $offers
 * @property-read int|null $offers_count
 * @method static Builder<static>|Listing withoutSold()
 * @property string|null $sold_at
 * @method static Builder<static>|Listing whereSoldAt($value)
 * @mixin \Eloquent
 */
class Listing extends Model {
	/** @use HasFactory<\Database\Factories\ListingFactory> */
	use HasFactory, SoftDeletes;
	protected $fillable = [ 
		'user_id',
		'beds',
		'baths',
		'area',
		'city',
		'code',
		'street',
		'street_nr',
		'price',
		'sold_at'
	];

	protected $sortable = [ 'price', 'created_at' ];

	public function user(): BelongsTo {
		return $this->belongsTo( User::class);
	}

	public function listingImages(): HasMany {
		return $this->hasMany( ListingImage::class);
	}

	public function offers(): HasMany {
		return $this->hasMany( Offer::class);
	}

	public function scopeFilter( Builder $query, array $filters ) {
		$query->when(
			$filters['priceFrom'] ?? false,
			fn( Builder $q, $f ) => $q->where( 'price', '>=', $f ) )
			->when(
				$filters['priceTo'] ?? false,
				fn( Builder $q, $f ) => $q->where( 'price', '<=', $f ) )
			->when(
				$filters['areaFrom'] ?? false,
				fn( Builder $q, $f ) => $q->where( 'area', '>=', $f ) )
			->when(
				$filters['areaTo'] ?? false,
				fn( Builder $q, $f ) => $q->where( 'area', '<=', $f ) )
			->when(
				$filters['beds'] ?? false,
				function (Builder $q, $f) {
					if ( $f === '6+' ) {
						$q->where( 'beds', '>=', 6 );
					} else {
						$q->where( 'beds', $f );
					}
				} )
			->when(
				$filters['baths'] ?? false,
				function (Builder $q, $f) {
					if ( $f === '6+' ) {
						$q->where( 'baths', '>=', 6 );
					} else {
						$q->where( 'baths', $f );
					}
				} )->when( $filters['deleted'] ?? false, function (Builder $q, $f) {
					return $q->withTrashed();
				} )->when( $filters['by'] ?? false, function (Builder $q, $f) use ($filters) {
					if ( collect( $this->sortable )->contains( $f ) ) {
						return $q->orderBy( $f, Arr::get( $filters, 'order' ) === 'desc' ? 'desc' : 'asc' );
					} else {
						return $q;
					}
				} );
	}
	public function scopeWithoutSold( Builder $q ) {
		return $q->whereNull( 'sold_at' );
		// return $q->doesntHave( 'offers' )
		// 	->orWhereHas( 'offers',
		// 		fn( Builder $query ) =>
		// 		$query->whereNull( 'accepted_at' )->whereNull( 'rejected_at' )
		// 	);

	}
}
