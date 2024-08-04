<script setup lang="ts">
    import {Head, Link} from '@inertiajs/vue3';
    import {ref} from "vue";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import ApplicationLogo from "@/Components/ApplicationLogo.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    defineProps({
        auth: Object
    })

    const name = ref('');
</script>

<template>
    <Head title="List"/>

    <StandardLayout>
        <div class="mb-10 pt-6">
            <!--            <ApplicationLogo width="150px" height="150px"/>-->
            <h1 class="text-2xl font-bold mb-4">apps4macs 👨‍💻</h1>
            <div class="text-lg mb-4 text-gray-500">
                <p>No-brainer apps for devs and powerusers</p>
                <p>Verified and maintained by "HumanIntelligence"</p>
            </div>
            <Link :href="auth?.user ? '/new-app/specify-if-paid' : '/sign-up'">
                <BaseButton class="shadow-2xl">
                    <v-icon name="co-plus" class="mr-2"/>
                    Submit new app
                </BaseButton>
            </Link>
        </div>

        <div class="flex justify-center mb-10">
            <BaseInput v-model="name" class="w-full shadow-xl" placeholder='Search...' variant="primary"/>
        </div>

        <div class="grid grid-cols-4 gap-4 h-32">
            <div class="bg-base-100 rounded-xl shadow-xl p-2 cursor-pointer border border-primary border-1">
                <div class="flex items-center mb-2">
                    <ApplicationLogo width="50px" height="50px" class="mr-5"/>
                    <span class="font-bold">Application name</span>
                </div>
                <span>Short brief of what this application does and how it will simplify life of every user...</span>
            </div>
        </div>
    </StandardLayout>
</template>
