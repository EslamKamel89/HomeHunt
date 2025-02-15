<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string $filename
 * @property int $listing_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Listing $listing
 * @method static \Database\Factories\ListingImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListingImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ListingImage extends Model {
	/** @use HasFactory<\Database\Factories\ListgingImageFactory> */
	use HasFactory; // @phpstan-ignore-line
	protected $fillable = [ 
		'filename',
		'listing_id',
	];
	public function listing(): BelongsTo {
		return $this->belongsTo( Listing::class);
	}
	public function filename(): Attribute {
		return Attribute::make(
			get: fn( string $value ) => asset( 'storage/' . $value ),
			set: fn( string $value ) => $value,
		);

	}
}
