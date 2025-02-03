<template>
    <span>{{ formatedPrice }}</span>
</template>

<script lang="ts" setup>
import { computed } from 'vue';

const props = defineProps<{
    price: string | number;
}>();
const formatedPrice = computed(() => {
    // return props.price;
    try {
        return Number(props.price).toLocaleString('en', {
            currency: 'USD',
            style: 'currency',
            maximumFractionDigits: 2,
        });
    } catch (error) {
        return props.price;
    }
});
</script>
