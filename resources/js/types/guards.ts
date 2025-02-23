import { OfferNotification } from './types';

export function isOffer(obj: unknown): obj is OfferNotification {
    return (
        typeof obj === 'object' &&
        obj !== null &&
        'offer_id' in obj &&
        typeof (obj as OfferNotification).offer_id === 'number' &&
        'listing_id' in obj &&
        typeof (obj as OfferNotification).listing_id === 'number' &&
        'amount' in obj &&
        typeof (obj as OfferNotification).amount === 'number' &&
        'bidder_id' in obj &&
        typeof (obj as OfferNotification).bidder_id === 'number'
    );
}
