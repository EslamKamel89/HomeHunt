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
    <div v-for="listing in listings" :key="listing.id" class="mt-2">
        <div class="flex items-center justify-between">
            <Link :href="route('listing.show', { id: listing.id })">
                <ListingAddress :listing />
            </Link>
            <div class="flex gap-x-2">
                <Link
                    class="btn btn-outline"
                    :href="route('listing.edit', { id: listing.id })"
                >
                    Edit
                </Link>
                <Link
                    class="btn btn-error text-white"
                    method="delete"
                    :href="route('listing.destroy', { id: listing.id })"
                    preserve-state
                    preserve-scroll
                    >Delete</Link
                >
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Alert from '@/Components/Alert.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
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
