<template>
    <h2 class="mb-5 text-2xl font-bold">Listing - Create</h2>
    <form
        @submit.prevent="form.post('/listing')"
        class="flex flex-col gap-4 md:grid md:grid-cols-6"
    >
        <CustomInput
            label="How many beds exist?"
            type="number"
            placeholder="Beds"
            v-model.number="form.beds"
            :error="page.props.errors.beds"
            class="col-span-3"
        />
        <CustomInput
            label="How many baths exist?"
            type="number"
            placeholder="Baths"
            v-model.number="form.baths"
            :error="page.props.errors.baths"
            class="col-span-3"
        />
        <CustomInput
            label="What's the property area?"
            type="number"
            placeholder="Area"
            v-model.number="form.area"
            :error="page.props.errors.area"
            class="col-span-3"
        />
        <CustomInput
            label="Enter City"
            type="text"
            placeholder="City"
            v-model="form.city"
            :error="page.props.errors.city"
            class="col-span-3"
        />
        <CustomInput
            label="Enter Code"
            type="text"
            placeholder="Code"
            v-model="form.code"
            :error="page.props.errors.code"
            class="col-span-3"
        />
        <CustomInput
            label="Enter Street Name"
            type="text"
            placeholder="Street Name"
            v-model="form.street"
            :error="page.props.errors.street"
            class="col-span-3"
        />
        <CustomInput
            label="Enter Street Number"
            type="number"
            placeholder="Street Number"
            v-model.number="form.street_nr"
            :error="page.props.errors.street_nr"
            class="col-span-3"
        />
        <CustomInput
            label="Enter Property Price"
            type="number"
            placeholder="Property Price"
            v-model.number="form.price"
            :error="page.props.errors.price"
            class="col-span-3"
        />
        <button type="submit" class="btn btn-accent col-span-6">Create</button>
    </form>
</template>

<script lang="ts" setup>
import CustomInput from '@/Components/CustomInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ListingForm } from '@/types/types';
import { useForm, usePage } from '@inertiajs/vue3';

const form = useForm<ListingForm>({
    beds: null,
    baths: null,
    area: null,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: null,
});
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
const page = usePage();
</script>
