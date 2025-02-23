<template>
    <h2 class="mb-2 border-b border-gray-300 pb-3 text-2xl font-bold">
        Your notifications
    </h2>
    <section v-if="notifications.data.length > 0" class="text-gray-700">
        <div v-for="notification in notifications.data" :key="notification.id!">
            <div
                class="flex items-center justify-between border-b border-gray-300 py-4"
            >
                <div
                    v-if="
                        notification.type == 'App\\Notifications\\OfferMade' &&
                        isOffer(notification.data)
                    "
                >
                    <div>
                        Offer was made for this
                        <Link
                            class="text-blue-500 underline underline-offset-4"
                            :href="
                                route('realtor-listing.show', {
                                    listing: notification.notifiable_id,
                                })
                            "
                            >Listing</Link
                        >
                        @
                        {{ formatDate(notification.created_at) }}
                    </div>
                    <div>
                        <div>
                            Offer:
                            <Price :price="notification.data.amount ?? 0" />
                        </div>
                    </div>
                </div>
                <Link
                    v-if="!notification.read_at"
                    class="btn btn-primary btn-sm text-xs uppercase"
                    :href="
                        route('notification.seen', {
                            notification: notification.id,
                        })
                    "
                    method="put"
                >
                    Mark as read
                </Link>
            </div>
        </div>
    </section>
    <section v-else>
        <EmptyState> No Notifications for you yet </EmptyState>
    </section>
    <PaginationComp :links="notifications.links" />
</template>

<script setup lang="ts">
import PaginationComp from '@/Components/PaginationComp.vue';
import Price from '@/Components/Price.vue';
import EmptyState from '@/Components/UI/EmptyState.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { isOffer } from '@/types/guards';
import { Notification, Pagination } from '@/types/types';

defineOptions({
    layout: MainLayout,
});
const props = defineProps<{
    notifications: Pagination<Notification<unknown>>;
}>();
const formatDate = (dateStr: string | null) => {
    if (!dateStr) return new Date().toLocaleString();
    return new Date(dateStr).toLocaleString();
};
</script>
