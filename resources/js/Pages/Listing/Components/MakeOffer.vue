<template>
    <Box class="mt-2">
        <template #header>Make an offer</template>
        <div>
            <form @submit.prevent="makeOffer">
                <CustomInput
                    label="Offer"
                    placeholder="Please Enter Offer"
                    :error="$page.props.errors.amount"
                    type="number"
                    v-model.number="form.amount"
                />
                <CustomSlider
                    label=""
                    :min="min"
                    :max="max"
                    :step="1000"
                    v-model.number="form.amount"
                />
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button type="submit" class="btn btn-primary my-4">
                            Make an offer
                        </button>
                        <div
                            v-if="$page.props.flash.success?.includes('Offer')"
                        >
                            <CheckBadgeIcon class="h-12 w-12 text-green-500" />
                        </div>
                    </div>
                    <button type="button" class="btn btn-ghost" @click="reset">
                        Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-2 flex justify-between text-gray-500">
            <div>Difference</div>
            <div><Price :price="difference" /></div>
        </div>
    </Box>
</template>

<script lang="ts" setup>
import CustomInput from '@/Components/CustomInput.vue';
import CustomSlider from '@/Components/CustomSlider.vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
import { CheckBadgeIcon } from '@heroicons/vue/24/solid';
import { useForm } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { computed, watch } from 'vue';

defineOptions({
    layout: MainLayout,
});
const props = defineProps<{
    listing: Listing;
}>();
const form = useForm({
    amount: props.listing.price,
});

const difference = computed(() => props.listing.price - form.amount);
const min = computed(
    () => Math.floor((props.listing.price * 0.5) / 1000) * 1000,
);
const max = computed(() => Math.floor((props.listing.price * 2) / 1000) * 1000);
const reset = () => {
    form.amount = props.listing.price;
};
const makeOffer = () => {
    form.post(route('listing.offer.store', { listing: props.listing.id }), {
        preserveScroll: true,
        preserveState: true,
    });
};
const emit = defineEmits<{
    offerUpdated: [offer: number];
}>();
watch(
    () => form.amount,
    debounce(() => {
        emit('offerUpdated', form.amount);
    }, 500),
);
</script>
