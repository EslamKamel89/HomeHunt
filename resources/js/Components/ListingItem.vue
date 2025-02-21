<template>
    <Box class="mt-2">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-y-2">
                <div class="flex items-center gap-x-4">
                    <Link
                        :href="
                            route('realtor-listing.show', { id: listing.id })
                        "
                    >
                        <ListingAddress :listing />
                    </Link>
                    <template
                        v-if="$page.props.auth.user.id == listing.user_id"
                    >
                        <div class="flex flex-col items-center">
                            <BookmarkIcon class="h-8 w-8" />
                            <div class="text-center text-xs text-gray-500">
                                Posted by me
                            </div>
                        </div>
                    </template>
                </div>
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> PM
                    </div>
                </div>

                <ListingSpace :listing="listing" />
            </div>
            <!-- <div class="ml-2 flex gap-2 sm:flex-col">
                <Link
                    class="btn btn-outline"
                    :href="route('listing.edit', { id: listing.id })"
                >
                    Edit
                </Link>
                <Link
                    class="btn btn-error text-white"
                    method="delete"
                    :href="route('listing.destroy', { id: listing.id })"
                    preserve-state
                    preserve-scroll
                    >Delete</Link
                >
            </div> -->
        </div>
    </Box>
</template>

<script lang="ts" setup>
import useMonthlyPayment from '@/Composables/useMonthlyPayment';
import { Listing } from '@/types/types';
import { BookmarkIcon } from '@heroicons/vue/24/solid';
import ListingAddress from './ListingAddress.vue';
import ListingSpace from './ListingSpace.vue';
import Price from './Price.vue';
import Box from './UI/Box.vue';

const props = defineProps<{
    listing: Listing;
}>();

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
