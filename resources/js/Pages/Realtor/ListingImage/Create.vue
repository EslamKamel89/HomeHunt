<template>
    <h2 class="mb-3 text-2xl font-bold">Listing - Index</h2>

    <Box>
        <template #header>Upload new images</template>
        <form @submit.prevent="uploadFiles" class="mt-2 flex items-start gap-2">
            <input
                type="file"
                multiple
                class="file-input file-input-bordered w-full max-w-xs"
                @change="handleFileChange"
                accept="image/*"
            />
            <div class="flex max-w-xs flex-col gap-y-2">
                <button
                    class="btn btn-primary mx-3"
                    :disabled="disableUpload()"
                    type="submit"
                >
                    Upload
                </button>
                <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                >
                    {{ form.progress.percentage }}%
                </progress>
            </div>
            <button
                class="btn btn-error text-white"
                type="reset"
                @click="resetFileInput"
            >
                Reset
            </button>
        </form>
    </Box>
    <Box
        v-if="listing.listing_images && listing.listing_images.length"
        class="mt-2"
    >
        <template #header>Current Listing Images</template>
        <div class="grid grid-cols-3">
            <Box
                v-for="image in listing.listing_images"
                :key="image.id"
                class="relative flex flex-col items-center justify-between gap-y-2"
            >
                <div class="absolute top-0">
                    <Link
                        :href="
                            route('listing.image.destroy', {
                                listing: listing.id,
                                listing_image: image.id,
                            })
                        "
                        method="delete"
                        as="button"
                        class="btn btn-error bg-red-600 text-white"
                    >
                        <TrashIcon class="size-6 text-white" />
                    </Link>
                </div>
                <img
                    :src="image.filename"
                    alt="Image Not Found"
                    class="img-fluid min-h-full min-w-full rounded-lg object-cover shadow-lg"
                />
            </Box>
        </div>
    </Box>
</template>
<script lang="ts" setup>
import Box from '@/Components/UI/Box.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing } from '@/types/types';
import { TrashIcon } from '@heroicons/vue/24/solid';
import { useForm } from '@inertiajs/vue3';
defineOptions({ layout: MainLayout });

const props = defineProps<{
    listing: Listing;
    csrf: string;
}>();

const form = useForm({
    images: [] as File[],
});

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (!target.files) return;
    form.images = Array.from(target.files);
};

const uploadFiles = () => {
    if (disableUpload()) return;
    const formData = new FormData();
    form.images.forEach((file) => {
        formData.append('images[]', file);
    });
    form.post(route('listing.image.store', { listing: props.listing.id }), {
        forceFormData: true,
        onSuccess() {
            form.images = [];
        },
    });
};

const resetFileInput = () => {
    form.images = [];
};

const disableUpload = () => {
    return form.images.length === 0;
};
</script>
