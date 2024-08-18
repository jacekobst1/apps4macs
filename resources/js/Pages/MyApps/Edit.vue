<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import BaseTextarea from "@/Components/form/BaseTextarea.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
    import BaseLabel from "@/Components/form/BaseLabel.vue";

    const props = defineProps<{
        app: App.Resources.AppResource,
    }>();

    const form = useForm<{
        logo: File | null,
        title: string | null,
        sentence: string | null,
        description: string | null,
    }>({
        logo: null,
        title: props.app.title,
        sentence: props.app.sentence,
        description: props.app.description,
    })

    function submit() {
        form.put('/my-apps/' + props.app.id);
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
        <div class="min-h-screen flex justify-center items-center -top-8 relative">
            <div>
                <div class="w-full mb-6">
                    <h1 class="font-bold text-xl">Edit app</h1>
                </div>
                <form @submit.prevent="submit" class="min-w-96 max-w-lg">
                    <div class="mb-4">
                        <BaseLabel text="New logo" tooltip-text="Upload only if you want to change the current one">
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
                            v-model="app.url"
                            label="Url"
                            placeholder="https://super-cool-landing-page.com"
                            variant="primary"
                            disabled
                            tooltip-text="Editing of this field is blocked. If you want to change it, delete this app, and create new one."
                        >
                        </BaseInput>
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
                    <div class="mb-4">
                        <BaseCheckbox
                            v-model="app.is_paid"
                            label="Is this a paid app?"
                            variant="primary"
                            class="mb-2"
                            disabled="true"
                            tooltip-text="Editing of this field is blocked. If you want to change it, delete this app, and create new one."
                        />
                    </div>
                    <div class="flex justify-end">
                        <BaseButton @click="$back" type="button" variant="default" class="mr-4 w-20">
                            Cancel
                        </BaseButton>
                        <BaseButton type="submit" class="w-20">Save</BaseButton>
                    </div>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
