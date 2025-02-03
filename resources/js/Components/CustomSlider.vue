<template>
    <div>
        <label class="font-semibold text-gray-500">{{ label }}</label>
        <div class="mb-1 flex justify-between">
            <div
                class="min-w-6 rounded-full border bg-gray-800 p-1 text-center text-xs text-white"
            >
                {{ min }}
            </div>
            <div
                class="min-w-6 rounded-full border bg-gray-800 p-1 text-center text-xs text-white"
            >
                {{ max }}
            </div>
        </div>
        <input
            type="range"
            :min="min"
            :max="max"
            class="range"
            :step="step"
            v-model="input"
        />
        <div class="flex w-full justify-between px-2 text-xs">
            <span>|</span>
            <span>|</span>
            <span>|</span>
            <span>|</span>
            <span>|</span>
        </div>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    label: string;
    min: number;
    max: number;
    step: number;
}>();
const input = defineModel();
</script>
