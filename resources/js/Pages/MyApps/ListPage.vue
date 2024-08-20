<script setup lang="ts">
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import {Head, Link, useForm} from "@inertiajs/vue3";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import AppTile from "@/Components/AppTile.vue";

    defineProps<{
        apps: Array<App.Resources.AppResource>;
    }>();

    const deleteForm = useForm({});

    function deleteApp(id: string) {
        deleteForm.delete(`/my-apps/${id}`);
    }
</script>

<template>
    <Head title="My apps"/>

    <StandardLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    My apps
                </h2>
                <Link :href="route('new-app.specify-if-paid')">
                    <BaseButton class="shadow-2xl">
                        Add new
                    </BaseButton>
                </Link>
            </div>
        </template>

        <div class="w-full sm:w-fit overflow-x-auto">
            <table class="table">
                <thead>
                <tr>
                    <th>Tile</th>
                    <th>Is paid</th>
                    <th>Status</th>
                    <th>Submitted at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="app in apps" :key="app.id">
                    <td>
                        <AppTile :app="app" class="!shadow-none"/>
                    </td>
                    <td>
                        <span>{{ app.is_paid ? 'Yes' : 'No' }}</span>
                    </td>
                    <td class="first-letter:capitalize">
                        <span>{{ app.status }}</span>
                    </td>
                    <td>
                        <span>{{ app.created_at ? new Date(app.created_at).toLocaleDateString() : '' }}</span>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <Link :href="'/my-apps/' + app.id + '/edit'">
                                <BaseButton variant="outline-info" size="sm" class="mb-1 w-full">
                                    Edit
                                </BaseButton>
                            </Link>
                            <BaseButton
                                @click="deleteApp(app.id)"
                                :disabled="deleteForm.processing"
                                variant="outline-error"
                                size="sm"
                                class="w-full"
                            >
                                Delete
                            </BaseButton>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
