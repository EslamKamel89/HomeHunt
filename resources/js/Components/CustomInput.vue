<template>
    <label class="max-max-w-xs form-control my-2 w-full">
        <div class="label">
            <span class="label-text">{{ label }}</span>
        </div>
        <input
            :type="type"
            min="0"
            :placeholder="placeholder"
            class="input input-bordered w-full max-w-xs"
            :class="{ 'border-red-500': error }"
            v-model="input"
        />
        <div v-if="error" class="text-xs text-red-500">{{ error }}</div>
    </label>
</template>
<script lang="ts" setup>
defineProps<{
    label: string;
    type: string;
    placeholder: string;
    error?: string;
}>();
const input = defineModel();
</script>
