<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import Datepicker from 'vue3-datepicker';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const user = usePage().props.value.auth.user;
const form = useForm({
    firstName: user.firstName,
    lastName: user.lastName,
    date_of_birth: ref(new Date(user.date_of_birth)),
});
var successMsg = ''
const submit = () => {
    form.post(route('updateProfile'), {
        onSuccess: () => alert('Successfully saved!'),
    });
};
</script>

<template>
    <BreezeAuthenticatedLayout>
        <Head title="My Profile" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Profile
            </h2>
        </template>
        <div class="w-full lg:max-w-md mx-auto mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg">
          <form @submit.prevent="submit">
              <div class="mt-4">
                  <BreezeLabel for="firstName" value="First Name" />
                  <BreezeInput id="firstName" type="text" class="mt-1 block w-full" v-model="form.firstName" required autofocus/>
                  <BreezeInputError class="mt-2" :message="form.errors.firstName" />
              </div>

              <div class="mt-4">
                  <BreezeLabel for="lastName" value="Last Name" />
                  <BreezeInput id="lastName" type="text" class="mt-1 block w-full" v-model="form.lastName" required />
                  <BreezeInputError class="mt-2" :message="form.errors.lastName" />
              </div>

              <div class="mt-4">
                  <BreezeLabel for="date_of_birth" value="Date of Birth" />
                  <datepicker id="date_of_birth" type="text" class="mt-1 block w-full" v-model="form.date_of_birth" required />
                  <BreezeInputError class="mt-2" :message="form.errors.date_of_birth" />
              </div>

              <div class="flex items-center justify-end mt-4">

                  <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                      Update Profile
                  </BreezeButton>
              </div>
          </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
