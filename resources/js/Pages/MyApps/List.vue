<script setup lang="ts">
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    defineProps<{
        apps: Array<App.Resources.AppResource>;
    }>();
</script>

<template>
    <Head title="My apps"/>

    <StandardLayout>
        <div class="flex flex-col items-center w-max mx-auto">
            <div class="w-full flex items-center mt-10 mb-5 justify-between">
                <h1 class="text-lg font-bold mr-16">My apps</h1>
                <Link href="/new-app/specify-if-paid">
                    <BaseButton size="sm" class="shadow-2xl">
                        Add new
                    </BaseButton>
                </Link>
            </div>

            <div class="overflow-x-auto w-fit">
                <table class="table">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Submitted at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    <tr v-for="app in apps" :key="app.id">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img
                                            :src="app.logo_url"
                                            alt="App logo"/>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{ app.title }}</div>
                                    <div class="text-sm opacity-50">{{ app.sentence }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>{{ app.created_at ? new Date(app.created_at).toLocaleDateString() : '' }}</span>
                        </td>
                        <th>
                            <Link :href="'/my-apps/' + app.id + '/edit'">
                                <BaseButton variant="ghost">Edit</BaseButton>
                            </Link>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
