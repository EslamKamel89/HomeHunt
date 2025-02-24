<template>
    <h2 class="mb-2 text-2xl font-bold">Email Verification</h2>
    <div>You need to be verified first to see this page</div>
    <Link
        :href="route('verification.send')"
        class="btn btn-primary btn-sm mt-3 text-xs"
        method="post"
        >Resend Verification Email</Link
    >
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';

defineOptions({
    layout: MainLayout,
});
</script>
