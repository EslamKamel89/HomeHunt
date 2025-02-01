<template>
    <span>{{ `${listing.street} ${listing.street_nr}, ${listing.city}` }}</span>
</template>
<script setup lang="ts">
import { Listing } from '@/types/types';

defineProps<{
    listing: Listing;
}>();
</script>
