<template>
    <div class="flex flex-col gap-2">
        <OfferItem
            v-for="offer in listing.offers"
            :key="offer.id!"
            :offer="offer"
            :listing-price="listing.price"
        />
    </div>
</template>

<script setup lang="ts">
import { Listing } from '@/types/types';
import OfferItem from './OfferItem.vue';

const props = defineProps<{
    listing: Listing;
}>();

const formateDate = (date: string | null) => {
    if (!date) return null;
    return new Date(date).toLocaleDateString();
};
</script>
