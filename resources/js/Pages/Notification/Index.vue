<template>
    <div>{{ notifications.data }}</div>
    <PaginationComp :links="notifications.links" />
</template>

<script setup lang="ts">
import PaginationComp from '@/Components/PaginationComp.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Pagination } from '@/types/types';

defineOptions({
    layout: MainLayout,
});
const props = defineProps<{
    notifications: Pagination<Notification>;
}>();
</script>
