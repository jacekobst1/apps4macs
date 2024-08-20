<script setup lang="ts">
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseTextarea from "@/Components/form/BaseTextarea.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    const props = defineProps<{
        app: App.Resources.AppResource;
    }>();

    const form = useForm({
        additional_info: null,
    })

    function accept() {
        form.post('/admin/submitted-apps/' + props.app.id + '/accept');
    }

    function reject() {
        form.post('/admin/submitted-apps/' + props.app.id + '/reject');
    }
</script>
<template>
    <StandardLayout>
        <Head title="Admin - submitted apps"/>

        <div>
            <h1 class="text-2xl font-bold mb-4">Submitted app</h1>
            <p>Url: {{ app.url }}</p>
            <p>User: {{ app.user?.email }}</p>
            <p>Created at: {{ app.created_at }}</p>

            <p>Title: {{ app.title }}</p>
            <p>Sentence: {{ app.sentence }}</p>
            <p>Description: {{ app.description }}</p>


            <div class="mt-20">
                <BaseTextarea v-model="form.additional_info" label="Mail content" rows="5"/>

                <BaseButton variant="success" @click="accept" class="mr-2">Accept</BaseButton>
                <BaseButton variant="error" @click="reject">Reject</BaseButton>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
