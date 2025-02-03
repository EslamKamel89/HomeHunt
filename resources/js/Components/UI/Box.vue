<template>
    <div class="rounded-md border border-gray-200 p-4 shadow-sm">
        <div class="text-lg font-bold text-gray-500">
            <slot name="header" />
        </div>
        <slot />
    </div>
</template>
