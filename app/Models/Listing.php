<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @mixin \Eloquent
 */
class Listing extends Model {
	/** @use HasFactory<\Database\Factories\ListingFactory> */
	use HasFactory;
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
	];

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
				} );
	}

	public function user(): BelongsTo {
		return $this->belongsTo( User::class);
	}
}
