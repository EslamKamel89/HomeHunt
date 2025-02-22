import { User } from './index.d.ts';
export type PaginationLink = {
    url: string | null;
    label: string | null;
    active: boolean;
};
export type Pagination<T> = {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: 7;
    last_page_url: string | null;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
};
export type Listing = {
    id: number;
    user_id: number;
    beds: number;
    baths: number;
    area: number;
    code: string;
    city: Goyetteshire;
    street: string;
    street_nr: number;
    price: number;
    deleted_at: string | null;
    listing_images_count?: number | null;
    offers_count?: number | null;
    listing_images?: ListingImage[];
    offers?: Offer[];
    sold_at?: string | null;
};

export type ListingImage = {
    created_at: string;
    filename: string;
    id: number;
    listing_id: number;
    updated_at: string;
};
export type ListingForm = {
    beds: number | null;
    baths: number | null;
    area: number | null;
    city: string | null;
    street: string | null;
    code: string | null;
    street_nr: number | null;
    price: number | null;
};

export type FiltersForm = {
    priceFrom?: number | null;
    priceTo?: number | null;
    beds?: string | null;
    baths?: string | null;
    areaFrom?: number | null;
    areaTo?: number | null;
};
export type Offer = {
    id: number | null;
    user_id: number | null;
    listing_id: number | null;
    amount: number | null;
    accepted_at: string | null;
    rejected_at: string | null;
    created_at: string | null;
    updated_at: string | null;
    user?: User | null;
};

type Notification<T> = {
    id?: string | null;
    type: string | null;
    notifiable_type: string | null;
    notifiable_id: number | null;
    data: T;
    read_at: string | null;
    created_at: string | null;
    updated_at: string | null;
};

type OfferNotification = {
    offer_id: number | null;
    listing_id: number | null;
    amount: number | null;
    bidder_id: number | null;
};
