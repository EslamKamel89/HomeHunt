<template>
    <div class="light container mx-auto max-w-5xl">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <Link href="/" class="btn btn-ghost text-xl">
                    <div class="flex flex-col items-start gap-0">
                        <div>HomeHunt</div>
                        <div v-if="user" class="text-xs text-gray-500">
                            Welcome {{ user.name }}
                        </div>
                    </div>
                </Link>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <template v-if="!user">
                        <li>
                            <details>
                                <summary>Account</summary>
                                <li>
                                    <Link :href="route('login')">Sign in</Link>
                                </li>
                                <li>
                                    <Link :href="route('user-account.create')"
                                        >Create account</Link
                                    >
                                </li>
                            </details>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <details>
                                <summary>{{ user.email }}</summary>
                                <ul>
                                    <li>
                                        <Link
                                            method="delete"
                                            as="button"
                                            :href="route('logout')"
                                            >Sign out</Link
                                        >
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </template>
                    <template v-if="user">
                        <li>
                            <details>
                                <summary>Listing</summary>
                                <ul class="rounded-t-none bg-base-100 p-2">
                                    <li>
                                        <Link
                                            :href="
                                                route('realtor-listing.index')
                                            "
                                            >Your Listings</Link
                                        >
                                    </li>
                                    <li>
                                        <Link :href="route('listing.index')"
                                            >All listing</Link
                                        >
                                    </li>
                                    <li>
                                        <Link
                                            :href="
                                                route('realtor-listing.create')
                                            "
                                            >Add</Link
                                        >
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </template>
                    <template v-if="user">
                        <li>
                            <Link
                                :href="route('notification.index')"
                                class="relative"
                            >
                                <BellAlertIcon class="h-6 w-6 text-gray-500" />
                                <span
                                    class="absolute right-[10px] top-0 rounded-full border border-red-500 bg-red-500 px-1 text-white"
                                    >{{
                                        user?.unread_notifications_count
                                    }}</span
                                >
                            </Link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <main class="px-8">
            <div>
                <template v-if="success">
                    <Alert
                        class="text-white"
                        :isError="false"
                        :content="success ?? 'Success'"
                    ></Alert>
                </template>
                <template v-if="error">
                    <Alert
                        class="text-white"
                        :isError="true"
                        :content="error ?? 'Error'"
                    ></Alert>
                </template>
            </div>
            <slot></slot>
        </main>
    </div>
</template>
<script setup lang="ts">
import Alert from '@/Components/Alert.vue';
import { User } from '@/types';
import pr from '@/Utils/pr';
import { BellAlertIcon } from '@heroicons/vue/24/solid';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed<User | null>(() => page.props.auth?.user);

const error = computed(() => page.props.flash.error);
const success = computed(() => pr(page.props.flash.success));
const unreadNotificationCount = computed(() => {
    let count = Math.min(
        page.props.auth.user.unread_notifications_count ?? 0,
        9,
    );
    return count == 9 ? count : `${count}+`;
});
</script>
