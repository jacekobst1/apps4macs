<script setup lang="ts">

    import {Head, useForm} from "@inertiajs/vue3";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    defineProps<{
        flash: {
            validationMessage?: string,
        },
    }>();

    const form = useForm({
        is_paid: 0,
    });

    function makeRequest(isPaid: boolean) {
        form.is_paid = isPaid ? 1 : 0;
        form.get('/new-app/submit');
    }
</script>

<template>
    <Head title="Specify if paid"/>

    <StandardLayout class="pt-0">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <h1 class="font-bold text-xl">Is your app paid?</h1>
            <div class="text-gray-400 text-sm mt-3">
                <p>
                    You can add only one free app.
                </p>
                <p class="mt-2">
                    Your app is considered to be paid, if you have at least 1 paid plan or feature.
                </p>
                <p>
                    All apps are regularly controlled to prevent scam.
                </p>
            </div>
            <div class="flex space-x-20 mt-10">
                <BaseButton @click="makeRequest(true)" :disabled=form.processing class="w-32 shadow-2xl">
                    Yes
                </BaseButton>
                <BaseButton @click="makeRequest(false)" :disabled="form.processing" class="w-32 shadow-2xl">
                    No
                </BaseButton>
            </div>
            <span v-if="flash.validationMessage" class="text-red-500 mt-5">{{ flash.validationMessage }}</span>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
