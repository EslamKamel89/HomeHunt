<template>
    <Box class="mt-2">
        <template #header>Offer Made</template>
        <Price :price="offer.amount ?? 0" class="text-3xl" />
        <section>
            <div class="mt-2 flex flex-row justify-between text-gray-500">
                <div>Made On</div>
                <div class="font-bold">{{ OfferMadeOn }}</div>
            </div>
            <hr class="my-2" />
        </section>
    </Box>
</template>
<script lang="ts" setup>
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import { Offer } from '@/types/types';
import { computed } from 'vue';

const props = defineProps<{
    offer: Offer;
}>();
const OfferMadeOn = computed(() => {
    if (!props.offer.created_at) return null;
    return new Date(props.offer.created_at).toLocaleDateString();
});
</script>
