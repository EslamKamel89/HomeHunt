<template>
    <Box>
        <template #header>Make an offer</template>
        <div>
            <form>
                <CustomInput
                    label="Offer"
                    placeholder="Please Enter Offer"
                    error=""
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
                    <button type="submit" class="btn btn-primary my-4">
                        Make an offer
                    </button>
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
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

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
</script>
