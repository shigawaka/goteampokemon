<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import Datepicker from 'vue3-datepicker';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const form = useForm({
    firstName: '',
    lastName: '',
    date_of_birth: ref(new Date()),
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <BreezeLabel for="firstName" value="First Name" />
                <BreezeInput id="firstName" type="text" class="mt-1 block w-full" v-model="form.firstName" required autofocus />
                <BreezeInputError class="mt-2" :message="form.errors.firstName" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="lastName" value="Last Name" />
                <BreezeInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.lastName" required />
                <BreezeInputError class="mt-2" :message="form.errors.lastName" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="date_of_birth" value="Date of Birth" />
                <datepicker id="date_of_birth" class="mt-1 block w-full" v-model="form.date_of_birth" required />
                <BreezeInputError class="mt-2" :message="form.errors.date_of_birth" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
