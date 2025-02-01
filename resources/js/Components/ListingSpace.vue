<template>
    <div>
        <span class="font-bold">{{ listing.beds }}</span>
        <span class="text-sm"> beds </span>
        <span class="text-gray-500"> | </span>
        <span class="font-bold">{{ listing.baths }}</span>
        <span class="text-sm"> baths </span>
        <span class="text-gray-500"> | </span>
        <span class="font-bold">{{ listing.area }}</span>
        <span class="text-sm"> area </span>
    </div>
</template>
<script lang="ts" setup>
import { Listing } from '@/types/types';

defineProps<{
    listing: Listing;
}>();
</script>
