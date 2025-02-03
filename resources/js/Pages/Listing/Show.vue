<template>
    <h2 class="text-2xl font-bold">Listing</h2>
    <div class="mt-4 flex flex-col-reverse gap-2 md:grid md:grid-cols-12">
        <Box class="flex items-center justify-center md:col-span-7">
            <div class="text-center font-medium text-gray-500">
                No images found
            </div>
        </Box>
        <div class="md:col-span-5">
            <Box class="">
                <template #header>Basic Info</template>
                <Price
                    :price="listing.price"
                    class="my-3 block text-2xl font-bold"
                />
                <ListingAddress :listing />
                <ListingSpace :listing="listing" />
            </Box>
            <Box class="mt-2">
                <template #header> Monthly Payment </template>
                <div>
                    <CustomSlider
                        label="Interest rates (2.5%)"
                        :min="0.1"
                        :step="0.1"
                        :max="30"
                        class="mt-2"
                    />
                    <CustomSlider
                        label="Duration (25 years)"
                        :min="3"
                        :step="1"
                        :max="30"
                        class="mt-2"
                    />
                    <div class="mt-2 flex flex-col gap-y-1">
                        <label class="font-semibold text-gray-500"
                            >Your Monthly Payment</label
                        >
                        <Price price="500" class="text-3xl" />
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script lang="ts" setup>
import CustomSlider from '@/Components/CustomSlider.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
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
