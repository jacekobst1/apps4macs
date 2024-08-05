<script setup lang="ts">
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import {Head, router, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import BaseTextarea from "@/Components/form/BaseTextarea.vue";

    const form = useForm({
        logo: null,
        url: null,
        title: null,
        sentence: null,
        description: null,
    })

    function submit() {
        router.post('/new-app/submit', {})
    }
</script>

<template>
    <Head title="Submit app"/>

    <GuestLayout class="pt-0">
        <div class="w-fit h-screen self-center flex flex-col justify-center">
            <div class="w-full mb-6">
                <h1 class="font-bold text-xl">Create new app!</h1>
            </div>
            <form @submit.prevent="submit" class="min-w-96 max-w-lg">
                <div class="mb-4">
                    <input type="file" class="file-input w-full max-w-xs"/>
                    <BaseInputError :text="form.errors?.logo"/>
                </div>
                <div class="mb-4">
                    <BaseInput
                        v-model="form.url"
                        label="Url"
                        placeholder="https://super-cool-landing-page.com"
                        variant="primary"
                    />
                    <BaseInputError :text="form.errors?.url"/>
                </div>
                <div class="mb-4">
                    <BaseInput
                        v-model="form.title"
                        label="Title"
                        variant="primary"
                    />
                    <BaseInputError :text="form.errors?.title"/>
                </div>
                <div class="mb-4">
                    <BaseInput
                        v-model="form.sentence"
                        label="Eye-catching sentence"
                        variant="primary"
                    />
                    <BaseInputError :text="form.errors?.sentence"/>
                </div>
                <div class="mb-4">
                    <BaseTextarea
                        v-model="form.description"
                        label="Description"
                        variant="primary"
                    />
                    <BaseInputError :text="form.errors?.description"/>
                </div>
                <BaseButton type="submit" class="w-full">Submit</BaseButton>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
