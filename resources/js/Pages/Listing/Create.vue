<template>
    <h2 class="mb-5 text-2xl font-bold">Listing - Create</h2>
    <form @submit.prevent="form.post('/listing')">
        <CustomInput
            label="How many beds exist?"
            type="number"
            placeholder="Beds"
            v-model.number="form.beds"
            :error="$page.props.errors.beds"
        />
        <CustomInput
            label="How many baths exist?"
            type="number"
            placeholder="Baths"
            v-model.number="form.baths"
            :error="$page.props.errors.baths"
        />
        <CustomInput
            label="What's the property area?"
            type="number"
            placeholder="Area"
            v-model.number="form.area"
            :error="$page.props.errors.area"
        />
        <CustomInput
            label="Enter City"
            type="text"
            placeholder="City"
            v-model="form.city"
            :error="$page.props.errors.city"
        />
        <CustomInput
            label="Enter Code"
            type="text"
            placeholder="Code"
            v-model="form.code"
            :error="$page.props.errors.code"
        />
        <CustomInput
            label="Enter Street Name"
            type="text"
            placeholder="Street Name"
            v-model="form.street"
            :error="$page.props.errors.street"
        />
        <CustomInput
            label="Enter Street Number"
            type="number"
            placeholder="Street Number"
            v-model.number="form.street_nr"
            :error="$page.props.errors.street_nr"
        />
        <CustomInput
            label="Enter Property Price"
            type="number"
            placeholder="Property Price"
            v-model.number="form.price"
            :error="$page.props.errors.price"
        />
        <button type="submit" class="btn btn-accent">Create</button>
    </form>
</template>

<script lang="ts" setup>
import CustomInput from '@/Components/CustomInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
type CreateForm = {
    beds: number | null;
    baths: number | null;
    area: number | null;
    city: string | null;
    street: string | null;
    code: string | null;
    street_nr: number | null;
    price: number | null;
};
const form = useForm({
    beds: null,
    baths: null,
    area: null,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: null,
});
watch(form, () => {
    console.log(form);
});
</script>

<script lang="ts">
export default {
    layout: MainLayout,
};
</script>
