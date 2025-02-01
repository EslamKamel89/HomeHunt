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
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <ListingItem
            v-for="listing in listings"
            :key="listing.id"
            class="mt-2"
            :listing="listing"
        >
        </ListingItem>
    </div>
</template>

<script lang="ts" setup>
import Alert from '@/Components/Alert.vue';
import ListingItem from '@/Components/ListingItem.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
defineProps<{
    listings: Listing[];
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
