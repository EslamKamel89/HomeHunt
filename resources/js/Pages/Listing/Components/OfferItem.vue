<template>
    <Box>
        <div class="flex flex-col justify-between gap-2 sm:flex-row">
            <div>
                <div class="text-4xl font-bold">
                    <Price :price="offer.amount ?? 0" />
                </div>
                <div v-if="offer.amount" class="text-gray-500">
                    Difference:
                    <span class="font-bold"
                        ><Price :price="priceDifference"
                    /></span>
                </div>
                <div class="text-gray-500">
                    Offer made by
                    <span class="font-bold">{{ offer.user?.name }}</span>
                    in
                    <span class="font-bold">{{ createdAt }}</span>
                </div>
            </div>
            <div class="flex flex-col justify-start gap-2">
                <button class="btn btn-success text-white">
                    <CheckBadgeIcon class="h-6 w-6" />
                    Accept
                </button>
                <button class="btn btn-error text-white">
                    <ArchiveBoxXMarkIcon class="h-6 w-6" />
                    Reject
                </button>
            </div>
        </div>
    </Box>
</template>

<script setup lang="ts">
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import { Offer } from '@/types/types';
import { ArchiveBoxXMarkIcon, CheckBadgeIcon } from '@heroicons/vue/24/solid';
import { computed } from 'vue';

const props = defineProps<{
    offer: Offer;
    listingPrice: number;
}>();

const createdAt = computed(() => {
    if (!props.offer.created_at) return null;
    return new Date(props.offer.created_at).toLocaleDateString();
});
const priceDifference = computed(() => {
    if (props.offer.amount == null) return 0;
    return props.offer.amount - props.listingPrice;
});
</script>
