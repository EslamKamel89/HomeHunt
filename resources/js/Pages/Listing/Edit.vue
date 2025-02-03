<template>
    <h2 class="text-2xl font-bold">Listing - Edit</h2>
    <form
        @submit.prevent="form.put(`/listing/${listing.id}`)"
        class="grid grid-cols-6 gap-4"
    >
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="How many beds exist?"
            type="number"
            placeholder="Beds"
            v-model.number="form.beds"
            :error="page.props.errors.beds"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="How many baths exist?"
            type="number"
            placeholder="Baths"
            v-model.number="form.baths"
            :error="page.props.errors.baths"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="What's the property area?"
            type="number"
            placeholder="Area"
            v-model.number="form.area"
            :error="page.props.errors.area"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="Enter City"
            type="text"
            placeholder="City"
            v-model="form.city"
            :error="page.props.errors.city"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="Enter Code"
            type="text"
            placeholder="Code"
            v-model="form.code"
            :error="page.props.errors.code"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="Enter Street Name"
            type="text"
            placeholder="Street Name"
            v-model="form.street"
            :error="page.props.errors.street"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="Enter Street Number"
            type="number"
            placeholder="Street Number"
            v-model.number="form.street_nr"
            :error="page.props.errors.street_nr"
        />
        <CustomInput
            class="col-span-6 md:col-span-3"
            label="Enter Property Price"
            type="number"
            placeholder="Property Price"
            v-model.number="form.price"
            :error="page.props.errors.price"
        />
        <button type="submit" class="btn btn-accent col-span-6">Save</button>
    </form>
</template>
<script lang="ts" setup>
import CustomInput from '@/Components/CustomInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Listing, ListingForm } from '@/types/types';
import { useForm, usePage } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });
const page = usePage();
const props = defineProps<{
    listing: Listing;
}>();
const form = useForm<ListingForm>({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});
</script>
