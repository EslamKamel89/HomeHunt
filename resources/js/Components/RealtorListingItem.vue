<template>
    <Box class="mt-2">
        <div class="itmes-center flex flex-col justify-center md:flex-row">
            <div class="flex flex-col items-center justify-center gap-y-2">
                <Link :href="route('listing.show', { id: listing.id })">
                    <ListingAddress :listing />
                </Link>
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> PM
                    </div>
                </div>

                <ListingSpace :listing="listing" />
            </div>
            <div
                class="mx-auto mt-2 flex items-stretch justify-center gap-2 md:flex-col"
            >
                <Link
                    class="btn btn-outline"
                    :href="route('realtor-listing.edit', { id: listing.id })"
                >
                    Edit
                </Link>
                <Link
                    class="btn btn-error text-white"
                    method="delete"
                    :href="route('realtor-listing.destroy', { id: listing.id })"
                    preserve-state
                    preserve-scroll
                    >Delete</Link
                >
            </div>
        </div>
    </Box>
</template>

<script lang="ts" setup>
import useMonthlyPayment from '@/Composables/useMonthlyPayment';
import { Listing } from '@/types/types';
import ListingAddress from './ListingAddress.vue';
import ListingSpace from './ListingSpace.vue';
import Price from './Price.vue';
import Box from './UI/Box.vue';

const props = defineProps<{
    listing: Listing;
}>();
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
