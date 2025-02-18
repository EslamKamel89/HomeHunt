<template>
    <div class="flex flex-col gap-2">
        <Box v-for="offer in offers" :key="offer.id!">
            <template #header> <Price :price="offer.amount ?? 0" /> </template>
        </Box>
    </div>
</template>

<script setup lang="ts">
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import { Offer } from '@/types/types';

defineProps<{
    offers: Offer[];
}>();
</script>
