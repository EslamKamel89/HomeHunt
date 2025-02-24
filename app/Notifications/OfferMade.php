<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferMade extends Notification {
	use Queueable;


	/**
	 * @param  Offer $offer
	 */
	public function __construct( private Offer $offer ) {
		// dd( $offer );
		$offer->load( [ 'listing' ] );
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via( object $notifiable ): array {
		return [ 'database', 'mail' ];
	}


	public function toMail( $notifiable ) {
		return ( new MailMessage )
			->subject( "New offer ({$this->offer->amount}) is made!" )
			->greeting( 'Hello ' . $notifiable->name . '!' )
			->line( 'We are happy to inform you that you have new offer on your listing.' )
			->action( 'Listing',
				route( 'realtor-listing.show', [ 'listing' => $this->offer->listing->id ] ) )
			->line( 'Thank you!' );
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( object $notifiable ): array {
		return [ 
			'offer_id' => $this->offer->id,
			'listing_id' => $this->offer->listing->id,
			'amount' => $this->offer->amount,
			'bidder_id' => $this->offer->user->id,
		];
	}
}
