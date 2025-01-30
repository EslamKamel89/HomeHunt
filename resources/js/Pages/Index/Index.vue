<template>
    <div>Index vue</div>
    <div>{{ message }}</div>
</template>

<script lang="ts" setup>
defineProps<{
    message: string;
}>();
</script>

<script lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
export default {
    layout: MainLayout,
};
</script>
