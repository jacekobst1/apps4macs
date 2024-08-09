<script setup lang="ts">
    import {Head, Link} from '@inertiajs/vue3';
    import {ref} from "vue";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    const props = defineProps<{
        auth: Record<string, any>;
        apps: Array<App.Resources.AppResource>;
    }>();

    const name = ref('');
</script>

<template>
    <Head title="List"/>

    <StandardLayout>
        <div class="mb-8 pt-6">
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

        <div class="flex justify-center mb-8">
            <BaseInput v-model="name" class="w-full shadow-xl" placeholder='Search...' variant="primary"/>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <a
                v-for="(app, index) in apps"
                :key="index"
                :href="app.url"
                class="flex items-center bg-base-100 rounded-xl shadow-xl p-2 cursor-pointer border border-primary border-1"
            >
                <div class="flex items-center">
                    <img
                        :src="app.logo_url !== '' ? app.logo_url : 'https://img.freepik.com/darmowe-wektory/logo-instagrama_1199-122.jpg'"
                        alt="logo"
                        class="mr-2 w-[70px] aspect-square rounded-xl"
                    />
                    <div class="self-start ml-1">
                        <p class="font-bold text-lg mb-1 text-gray-800">{{ app.title }}</p>
                        <p class="text-xs text-gray-700 truncate-lines">{{ app.sentence }}</p>
                    </div>
                </div>
            </a>
        </div>
    </StandardLayout>
</template>

<style scoped>
    .truncate-lines {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
