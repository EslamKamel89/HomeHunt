<template>
    <h2 class="text-2xl font-bold">Your Listing</h2>
    <!-- <template v-if="$page.props?.flash?.success">
        <Alert
            :isError="false"
            :content="$page.props?.flash?.success ?? 'Success'"
        ></Alert>
    </template>
    <template v-if="$page.props?.flash?.error">
        <Alert
            :isError="true"
            :content="$page.props?.flash?.error ?? 'Error'"
        ></Alert>
    </template> -->
    <RealtorFilters
        :deleted="filters?.deleted == 'true' ? true : false"
        :by="filters?.by ?? ''"
        :order="filters?.order ?? ''"
    />
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

<script lang="ts" setup>
import PaginationComp from '@/Components/PaginationComp.vue';
import RealtorListingItem from '@/Components/RealtorListingItem.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing, Pagination } from '@/types/types';
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
// pr(props?.listings.data.length, 'props in index.vue');
</script>
