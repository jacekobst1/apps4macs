<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import BaseTextarea from "@/Components/form/BaseTextarea.vue";
    import BaseLabel from "@/Components/form/BaseLabel.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    const props = defineProps<{
        is_paid: boolean,
        template_url: string | null,
    }>();

    const form = useForm<{
        logo: File | null,
        url: string | null,
        title: string | null,
        sentence: string | null,
        description: string | null,
        is_paid: boolean | null,
    }>({
        logo: null,
        url: null,
        title: null,
        sentence: null,
        description: null,
        is_paid: props.is_paid,
    })

    if (props.template_url) {
        form.url = props.template_url;
    }

    function submit() {
        form.post('/new-app/submit');
    }

    function handleFileChange(event: Event) {
        const input = event.target as HTMLInputElement;

        if (input.files && input.files.length > 0) {
            form.logo = input.files[0];
        }
    }
</script>

<template>
    <Head title="Submit app"/>

    <StandardLayout>
        <div class="min-h-screen flex justify-center items-center -top-16 relative">
            <div>
                <div class="w-full mb-6">
                    <h1 class="font-bold text-xl">Create new app!</h1>
                </div>
                <form @submit.prevent="submit" class="sm:min-w-96 max-w-lg">
                    <div class="mb-4">
                        <BaseLabel text="Logo">
                            <input
                                @change="handleFileChange"
                                type="file"
                                id="logo-file-input"
                                class="file-input file-input-sm md:file-input-md w-full"
                            />
                        </BaseLabel>
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
                    <BaseButton :disabled="form.processing" type="submit" class="w-full">Submit</BaseButton>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
