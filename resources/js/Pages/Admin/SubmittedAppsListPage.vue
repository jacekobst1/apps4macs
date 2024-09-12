<script setup lang="ts">
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import {Head, Link} from "@inertiajs/vue3";

    defineProps<{
        apps: Array<App.Resources.AppResource>;
    }>();
</script>

<template>
    <StandardLayout>
        <Head title="Admin - submitted apps"/>

        <div>
            <h1 class="text-2xl font-bold mb-4">Submitted apps</h1>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Url</th>
                        <th>User</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(app, index) in apps" :key="app.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ app.title }}</td>
                        <td>{{ app.url }}</td>
                        <td>{{ app.user?.email }}</td>
                        <td>{{ app.created_at }}</td>
                        <td>
                            <Link :href="'/admin/submitted-apps/' + app.id">
                                <button class="btn btn-primary">View</button>
                            </Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
