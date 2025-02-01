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
