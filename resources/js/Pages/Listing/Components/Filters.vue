<template>
    <form @submit.prevent="submit">
        <div class="mb-8 mt-4 flex flex-wrap items-center justify-start gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    class="w-[120px] rounded-s-md placeholder:text-sm"
                    placeholder="Price from"
                    v-model.number="form.priceFrom"
                />
                <input
                    type="number"
                    class="w-[120px] rounded-e-md placeholder:text-sm"
                    placeholder="Price to"
                    v-model.number="form.priceTo"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select
                    v-model="form.beds"
                    class="w-[120px] rounded-s-md placeholder:text-sm"
                >
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
                <select
                    v-model="form.baths"
                    class="w-[120px] rounded-e-md placeholder:text-sm"
                >
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    class="w-[120px] rounded-s-md placeholder:text-sm"
                    placeholder="Area from"
                    v-model.number="form.areaFrom"
                />
                <input
                    type="number"
                    class="w-[120px] rounded-e-md placeholder:text-sm"
                    placeholder="Area to"
                    v-model.number="form.areaTo"
                />
            </div>
            <div class="flex flex-nowrap">
                <button
                    type="submit"
                    class="text-whte w-[120px] rounded-s-md border border-blue-500 bg-blue-500 py-2 text-white"
                >
                    Find
                </button>
                <button
                    type="reset"
                    class="w-[120px] rounded-e-md border border-red-500 text-red-700"
                    @click="clear"
                >
                    Clear
                </button>
            </div>
        </div>
    </form>
</template>
<script lang="ts" setup>
import { FiltersForm } from '@/types/types';
import pr from '@/Utils/pr';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    filters?: FiltersForm;
}>();

const form = useForm<FiltersForm>({
    priceFrom: props?.filters?.priceFrom ?? null,
    priceTo: props?.filters?.priceTo ?? null,
    beds: props?.filters?.beds ?? null,
    baths: props?.filters?.baths ?? null,
    areaFrom: props?.filters?.areaFrom ?? null,
    areaTo: props?.filters?.areaTo ?? null,
});

const submit = () => {
    pr(form, 'Filters from');
    form.get(route('listing.index'), {
        preserveState: true,
        preserveScroll: true,
    });
};
const clear = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;
    submit();
};
</script>
