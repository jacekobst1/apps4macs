<script setup lang="ts">
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import {Head} from "@inertiajs/vue3";
    import BaseLinkButton from "@/Components/buttons/BaseLinkButton.vue";
</script>

<template>
    <Head title="Check email"/>

    <GuestLayout>
        <div class="w-fit h-screen self-center flex flex-col justify-center">
            <div class="card bg-white w-96 shadow-xl rounded-xl">
                <div class="card-body">
                    <v-icon name="io-mail-unread-outline" class="w-24 h-24"/>
                    <h2 class="card-title">Thank you for submitting your app!</h2>
                    <p>Check your email for login link. If it's not there, check spam folder</p>
                    <div class="card-actions justify-end">
                        <BaseLinkButton href="/list">Go back</BaseLinkButton>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
