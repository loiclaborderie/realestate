<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <Label for="name">Name</Label>

                <Input
                    id="name"
                    type="text"
                    v-model="form.name"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <Label for="email">Email</Label>

                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <Label for="password">Password</Label>

                <Input
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <Label for="password_confirmation">Confirm Password</Label>

                <Input
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
