<template>
    <h2 class="mb-3 text-2xl font-bold">Listing - Index</h2>
    <form
        method="post"
        enctype="multipart/form-data"
        :action="
            route('listing.image.store', { listing: listing.id, _token: csrf })
        "
    >
        <input
            type="file"
            multiple
            name="images[]"
            class="file-input file-input-bordered w-full max-w-xs"
        />
        <button class="btn btn-primary mx-3" type="submit">Upload</button>
    </form>
</template>
<script lang="ts" setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';

defineOptions({ layout: MainLayout });

defineProps<{
    listing: Listing;
    csrf: string;
}>();
</script>
