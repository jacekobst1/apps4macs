<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    const props = defineProps<{
        is_paid: boolean;
    }>();
</script>

<template>
    <Head title="Waiting for payment verification"/>

    <StandardLayout>
        <div class="flex flex-col items-center justify-center h-screen text-center space-y-6 -top-16 relative">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-16 h-16 border-4 border-t-4 border-t-blue-600 rounded-full animate-spin"></div>

                <h1 class="text-xl md:text-2xl font-bold">
                    Waiting for Payment Verification
                </h1>

                <p class="text-base md:text-lg text-gray-600">
                    Please wait while we verify your payment. You will be redirected
                    automatically.
                </p>
            </div>

            <div class="flex items-center space-x-2">
                <button class="btn btn-primary btn-outline loading">Verifying...</button>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
