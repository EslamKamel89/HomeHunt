<template>
    <h2 class="mb-5 text-2xl font-bold">Signup</h2>

    <div>
        <form
            @submit.prevent="submit"
            class="flex flex-col gap-4 md:grid md:grid-cols-6"
        >
            <CustomInput
                label="Name"
                placeholder="Please enter your name"
                type="text"
                class="col-span-3"
                :error="$page.props.errors.name"
                v-model="form.name"
            />
            <CustomInput
                label="Email"
                placeholder="Please enter your email"
                type="email"
                class="col-span-3"
                :error="$page.props.errors.eamil"
                v-model="form.email"
            />
            <CustomInput
                label="Password"
                placeholder="Please enter your password"
                type="password"
                class="col-span-3"
                :error="$page.props.errors.password"
                v-model="form.password"
            />
            <CustomInput
                label="Password Confirmation"
                placeholder="Please confirm you password"
                type="password"
                class="col-span-3"
                :error="$page.props.errors['password-confirm']"
                v-model="form.password_confimation"
            />
            <button type="submit" class="btn btn-accent col-span-6">
                Sign up
            </button>
        </form>
    </div>
</template>

<script setup lang="ts">
import CustomInput from '@/Components/CustomInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

type SignupForm = {
    name: string | null;
    email: string | null;
    password: string | null;
    password_confimation: string | null;
};
const form = useForm<SignupForm>({
    name: null,
    email: null,
    password: null,
    password_confimation: null,
});
const submit = () => {
    // todo sign up functionality
    // form.post(route('login'));
};
</script>
