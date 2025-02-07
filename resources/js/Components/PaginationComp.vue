<template>
    <div class="mt-5 flex justify-end gap-x-2">
        <div v-for="(link, index) in links" :key="index" class="">
            <Link
                :href="link.url"
                class="rounded-full border p-2"
                :class="{ 'bg-blue-500 text-white': link.active }"
                v-if="link.url && link.label !== '...'"
                preserve-state
                ><span v-html="link.label"></span
            ></Link>
            <div v-else-if="link.label === '...'">{{ link.label }}</div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { PaginationLink } from '@/types/types';

defineProps<{
    links: PaginationLink[];
}>();
</script>
