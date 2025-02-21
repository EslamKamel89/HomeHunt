<template>
    <Box
        class="mt-2"
        :class="{
            'border border-dashed border-red-500 opacity-50 shadow-md shadow-red-200':
                listing.deleted_at,
        }"
    >
        <div
            class="itmes-center flex flex-col justify-center gap-2 md:flex-row md:justify-between"
        >
            <div
                class="flex flex-col items-center justify-center gap-y-2 text-center"
            >
                <Link
                    :href="route('realtor-listing.show', { id: listing.id })"
                    class="flex items-center gap-3"
                >
                    <ListingAddress :listing />
                    <!-- <div class="btn">
                        Details
                        <CursorArrowRaysIcon class="h-9 w-9 text-gray-400" />
                    </div> -->
                </Link>
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> PM
                    </div>
                </div>

                <ListingSpace :listing="listing" />
                <Link
                    v-if="listing.offers_count"
                    class="btn px-7 text-white"
                    :class="{
                        'btn-warning': !listing.sold_at,
                        'btn-success': listing.sold_at,
                    }"
                    :href="route('realtor-listing.show', { id: listing.id })"
                >
                    <BriefcaseIcon class="h-8 w-8" />
                    <div v-if="listing.sold_at">Sold</div>
                    <div v-else class="flex items-center gap-x-2">
                        Offers
                        <span
                            class="flex items-center justify-center rounded-full border px-3 py-2 text-center"
                            >{{ listing.offers_count }}</span
                        >
                    </div>
                </Link>
            </div>
            <div
                class="mx-auto mt-2 flex items-stretch justify-center gap-2 md:flex-col"
            >
                <Link
                    class="btn btn-info text-white"
                    :href="route('listing.image.create', { id: listing.id })"
                >
                    Upload
                </Link>
                <Link
                    class="btn btn-outline"
                    :href="route('realtor-listing.edit', { id: listing.id })"
                >
                    Edit
                </Link>
                <Link
                    v-if="listing.deleted_at"
                    class="btn btn-success text-white"
                    method="put"
                    :href="
                        route(
                            'realtor-listing.restore',

                            { id: listing.id },
                        )
                    "
                    as="button"
                    preserve-scroll
                    >{{ 'Restore' }}</Link
                >
                <Link
                    v-else
                    class="btn btn-error text-white"
                    :method="'delete'"
                    :href="route('realtor-listing.destroy', { id: listing.id })"
                    as="button"
                    preserve-scroll
                    >{{ 'Delete' }}</Link
                >
            </div>
        </div>
    </Box>
</template>

<script lang="ts" setup>
import useMonthlyPayment from '@/Composables/useMonthlyPayment';
import { Listing } from '@/types/types';
import { BriefcaseIcon } from '@heroicons/vue/24/solid';
import ListingAddress from './ListingAddress.vue';
import ListingSpace from './ListingSpace.vue';
import Price from './Price.vue';
import Box from './UI/Box.vue';

const props = defineProps<{
    listing: Listing;
}>();
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
