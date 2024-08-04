<script setup lang="ts">

    import {Head, router} from "@inertiajs/vue3";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    function makeRequest(isPaid: boolean) {
        router.get('/new-app/submit', {
            isPaid: isPaid ? 1 : 0,
        });
    }
</script>

<template>
    <Head title="Specify if paid"/>

    <StandardLayout class="pt-0">
        <div class="min-h-screen flex flex-col justify-center items-center -top-16 relative">
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
                <BaseButton @click="makeRequest(true)" class="w-32 shadow-2xl">
                    Yes
                </BaseButton>
                <BaseButton @click="makeRequest(false)" class="w-32 shadow-2xl">
                    No
                </BaseButton>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
