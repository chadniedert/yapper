<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Yap from '@/Components/Yap.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['yaps']);

const form = useForm({
    message: '',
})

</script>
 
<template>
    <Head title="Yaps" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('yaps.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What noise do you need to create?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Yap</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Yap
                    v-for="yap in yaps"
                    :key="yap.id"
                    :yap="yap"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>