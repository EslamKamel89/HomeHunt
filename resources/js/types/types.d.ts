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
    beds: number;
    baths: number;
    area: number;
    code: string;
    city: Goyetteshire;
    street: string;
    street_nr: number;
    price: number;
    deleted_at: string | null;
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
