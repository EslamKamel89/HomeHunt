<template>
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <Box
            v-for="image in listing.listing_images"
            :key="image.id"
            class="relative flex flex-col items-center justify-between gap-y-2"
        >
            <div class="absolute top-0">
                <Link
                    :href="
                        route('listing.image.destroy', {
                            listing: listing.id,
                            listing_image: image.id,
                        })
                    "
                    method="delete"
                    as="button"
                    class="btn btn-error bg-red-600 text-white"
                >
                    <TrashIcon class="size-6 text-white" />
                </Link>
            </div>
            <img
                :src="image.filename"
                alt="Image Not Found"
                class="img-fluid min-h-full min-w-full rounded-lg object-cover shadow-lg"
            />
        </Box>
    </div>
</template>
<script lang="ts" setup>
import { Listing } from '@/types/types';
import { TrashIcon } from '@heroicons/vue/24/solid';
import Box from './UI/Box.vue';

defineProps<{ listing: Listing }>();
</script>
