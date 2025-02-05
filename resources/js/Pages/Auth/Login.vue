<template>
    <h2 class="mb-5 text-2xl font-bold">Signin</h2>

    <div>
        <form
            @submit.prevent="submit"
            class="flex flex-col gap-4 md:grid md:grid-cols-6"
        >
            <CustomInput
                label="Email"
                placeholder="Please enter your email"
                type="email"
                class="col-span-3"
                :error="form.errors.email"
                v-model="form.email"
            />
            <CustomInput
                label="Password"
                placeholder="Please enter your password"
                type="password"
                class="col-span-3"
                :error="form.errors.password"
                v-model="form.password"
            />

            <button type="submit" class="btn btn-accent col-span-6">
                Sign in
            </button>
        </form>
    </div>
</template>

<script setup lang="ts">
import CustomInput from '@/Components/CustomInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: MainLayout });

type LoginForm = {
    email: string | null;
    password: string | null;
};
const form = useForm<LoginForm>({
    email: null,
    password: null,
});
const submit = () => {
    form.post(route('login.store'));
};
</script>
