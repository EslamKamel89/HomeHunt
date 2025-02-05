<template>
    <div class="light container mx-auto max-w-5xl">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">
                    <div class="flex flex-col items-start gap-0">
                        <div>HomeHunt</div>
                        <div v-if="user" class="text-xs text-gray-500">
                            Welcome {{ user.name }}
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><Link href="/">Home Page</Link></li>
                    <template v-if="!$page.props.auth.user">
                        <li><Link :href="route('login')">Sign in</Link></li>
                    </template>
                    <template v-else>
                        <li>
                            <Link
                                method="delete"
                                as="button"
                                :href="route('logout')"
                                >Sign out</Link
                            >
                        </li>
                    </template>
                    <template v-if="user">
                        <li>
                            <details>
                                <summary>Listing</summary>
                                <ul class="rounded-t-none bg-base-100 p-2">
                                    <li>
                                        <Link :href="route('listing.index')"
                                            >View</Link
                                        >
                                    </li>
                                    <li>
                                        <Link :href="route('listing.create')"
                                            >Add</Link
                                        >
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <main class="px-8">
            <slot></slot>
        </main>
    </div>
</template>
<script setup lang="ts">
import { User } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed<User | null>(() => page.props.auth?.user);
</script>
