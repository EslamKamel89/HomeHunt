<template>
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Listing - Index</h2>
        <Link class="btn btn-primary btn-active" href="/listing/create"
            >Add</Link
        >
    </div>
    <template v-if="success">
        <Alert :isError="false" :content="success ?? 'Success'"></Alert>
    </template>
    <template v-if="error">
        <Alert :isError="true" :content="error ?? 'Error'"></Alert>
    </template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <ListingItem
            v-for="listing in listings.data"
            :key="listing.id"
            class="mt-2"
            :listing="listing"
        >
        </ListingItem>
    </div>
    <PaginationComp :links="listings.links" />
</template>

<script lang="ts" setup>
import Alert from '@/Components/Alert.vue';
import ListingItem from '@/Components/ListingItem.vue';
import PaginationComp from '@/Components/PaginationComp.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { FiltersForm, Listing, Pagination } from '@/types/types';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Filters from './Components/Filters.vue';
defineProps<{
    listings: Pagination<Listing>;
    filters?: FiltersForm;
}>();

const page = usePage();
const error = computed(() => page.props.flash.error);
const success = computed(() => page.props.flash.success);
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
</script>
