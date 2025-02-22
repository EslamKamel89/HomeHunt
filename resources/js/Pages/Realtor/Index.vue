<template>
    <h2 class="text-2xl font-bold">Your Listing</h2>

    <RealtorFilters
        :deleted="filters?.deleted == 'true' ? true : false"
        :by="filters?.by ?? ''"
        :order="filters?.order ?? ''"
    />
    <template v-if="listings.data.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <RealtorListingItem
                v-for="listing in listings.data"
                :key="listing.id"
                class="mt-2"
                :listing="listing"
            >
            </RealtorListingItem>
        </div>
        <PaginationComp :links="listings.links" />
    </template>
    <template v-else>
        <EmptyState>No Listing Found</EmptyState>
    </template>
</template>

<script lang="ts" setup>
import PaginationComp from '@/Components/PaginationComp.vue';
import RealtorListingItem from '@/Components/RealtorListingItem.vue';
import EmptyState from '@/Components/UI/EmptyState.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing, Pagination } from '@/types/types';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import RealtorFilters from './Index/Components/RealtorFilters.vue';

defineOptions({ layout: MainLayout });
const props = defineProps<{
    listings: Pagination<Listing>;
    filters?: {
        deleted?: number | string;
        by?: string;
        order?: string;
    };
}>();
onMounted(() => {
    router.reload();
});
</script>
