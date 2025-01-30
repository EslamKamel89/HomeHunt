<template>
    <h2 class="text-2xl font-bold">Listing - Show</h2>
    <div>
        <ListingAddress :listing />
    </div>
</template>

<script lang="ts" setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
defineProps<{
    listing: Listing;
}>();
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
</script>
