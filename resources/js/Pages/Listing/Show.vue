<template>
    <h2 class="text-2xl font-bold">Listing</h2>
    <div class="mt-4 flex flex-col-reverse gap-2 md:grid md:grid-cols-12">
        <Box class="md:col-span-7">
            <div class="">
                <template
                    v-if="
                        listing.listing_images &&
                        listing.listing_images.length > 0
                    "
                >
                    <ImagesDisplay :listing />
                </template>
                <template v-else>
                    <div>No images found</div>
                </template>
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
                        :label="`Interest rates (${interstRate}%)`"
                        :min="0.1"
                        :step="0.1"
                        :max="30"
                        class="mt-2"
                        v-model.number="interstRate"
                    />
                    <CustomSlider
                        :label="`Duration (${duration} years)`"
                        :min="3"
                        :step="1"
                        :max="30"
                        class="mt-2"
                        v-model.number="duration"
                    />
                    <div class="mt-2 flex flex-col gap-y-1">
                        <label class="font-semibold text-gray-500"
                            >Your Monthly Payment</label
                        >
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total Paid</div>
                            <div>
                                <Price
                                    :price="totalPayment"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Principal Paid</div>
                            <div>
                                <Price
                                    :price="listing.price"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total Interest</div>
                            <div>
                                <Price
                                    :price="totalInterest"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
            <template v-if="$page.props.auth.user.id != listing.user_id">
                <MakeOffer :listing="listing" @offer-updated="offerUpdated" />
            </template>
        </div>
    </div>
</template>

<script lang="ts" setup>
import CustomSlider from '@/Components/CustomSlider.vue';
import ImagesDisplay from '@/Components/ImagesDisplay.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import useMonthlyPayment from '@/Composables/useMonthlyPayment';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
import { ref } from 'vue';
import MakeOffer from './Components/MakeOffer.vue';

const props = defineProps<{
    listing: Listing;
}>();
const interstRate = ref<number>(2.5);
const duration = ref<number>(25);
const offerPrice = ref<number>(props.listing.price);

const offerUpdated = (offer: number) => {
    offerPrice.value = offer;
};

const { monthlyPayment, totalPayment, totalInterest } = useMonthlyPayment(
    offerPrice,
    interstRate,
    duration,
);
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
</script>
