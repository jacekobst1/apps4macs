<script setup lang="ts">
    import {Head} from '@inertiajs/vue3';
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import {ref} from "vue";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import ApplicationLogo from "@/Components/ApplicationLogo.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    const name = ref('');
</script>

<template>
    <Head title="Dashboard"/>

    <GuestLayout>
        <div class="mb-10 text-center">
            <!--            <ApplicationLogo width="150px" height="150px"/>-->
            <h1 class="text-2xl font-bold mb-4">apps4macs</h1>
            <div class="text-lg mb-4">
                <p>List of macos apps you can't go past</p>
                <p>Verified by human beings</p>
            </div>
            <BaseButton>Submit new app</BaseButton>
        </div>

        <div class="flex justify-center mb-10">
            <BaseInput placeholder="Search" v-model="name" class="w-96"/>
        </div>

        <div class="grid grid-cols-4 gap-4 h-32">
            <div class="bg-base-100 rounded-xl shadow-xl p-2 cursor-pointer">
                <div class="flex items-center mb-2">
                    <ApplicationLogo width="50px" height="50px" class="mr-5"/>
                    <span class="font-bold">Application name</span>
                </div>
                <span>Short brief of what this application does...</span>
            </div>
        </div>
    </GuestLayout>
</template>
