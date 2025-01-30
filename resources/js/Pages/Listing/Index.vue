<template>
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Listing - Index</h2>
        <Link class="btn btn-primary btn-active" href="/listing/create"
            >Add</Link
        >
    </div>
    <template v-if="$page.props.flash.success">
        <Alert
            :isError="false"
            :content="$page.props.flash.success ?? 'Success'"
        ></Alert>
    </template>
    <template v-else>
        <Alert
            :isError="true"
            :content="$page.props.flash.error ?? 'Error'"
        ></Alert>
    </template>
    <div v-for="listing in listings" :key="listing.id" class="mt-2">
        <Link :href="`/listing/${listing.id}`">
            <ListingAddress :listing />
        </Link>
    </div>
</template>

<script lang="ts" setup>
import Alert from '@/Components/Alert.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
defineProps<{
    listings: Listing[];
}>();
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
</script>
