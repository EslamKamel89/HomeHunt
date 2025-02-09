<template>
    <div class="my-4 flex flex-wrap gap-4">
        <div class="flex flex-nowrap items-center gap-2">
            <div class="form-control">
                <label class="label cursor-pointer">
                    <input
                        id="deleted"
                        type="checkbox"
                        v-model="form.deleted"
                        :checked="form.deleted"
                        class="checkbox-primary checkbox"
                    />
                    <span class="label-text ml-2">Deleted</span>
                </label>
            </div>
        </div>
        <div>
            <select
                v-model="form.by"
                class="select select-primary w-32 max-w-xs rounded-r-none"
            >
                <option value="created_at">Added</option>
                <option value="price">Price</option>
            </select>
            <select
                v-model="form.order"
                class="select select-primary w-32 max-w-xs rounded-l-none"
            >
                <option
                    v-for="option in sortLabels[form.by]"
                    :value="option.value"
                    :key="option.label"
                >
                    {{ option.label }}
                </option>
            </select>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { reactive, watch } from 'vue';

const sortLabels: Record<
    string,
    {
        label: string;
        value: string;
    }[]
> = {
    created_at: [
        { label: 'Latest', value: 'desc' },
        { label: 'Oldest', value: 'asc' },
    ],
    price: [
        { label: 'Pricey', value: 'desc' },
        { label: 'Cheapest', value: 'asc' },
    ],
};

const props = defineProps<{
    deleted: boolean;
}>();
const form = reactive({
    deleted: props.deleted,
    by: 'creaetd_at',
    order: 'desc',
});
watch(
    form,
    debounce(() => {
        router.get(route('realtor-listing.index'), form, {
            preserveScroll: true,
            preserveState: true,
        });
    }, 300),
);
</script>
