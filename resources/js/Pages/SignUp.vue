<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
    import Tooltip from "@/Components/form/BaseTooltip.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    const form = useForm({
        url: null,
        email: null,
        is_paid: false,
    })

    function makeRequest() {
        form.post('/sign-up')
    }
</script>

<template>
    <Head title="Sign up"/>

    <StandardLayout class="pt-0">
        <div class="min-h-screen flex justify-center items-center">
            <div>
                <div class="w-full mb-6">
                    <h1 class="font-bold text-xl">Submit your app</h1>
                </div>
                <form @submit.prevent="makeRequest" class="min-w-80 max-w-lg">
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
                            v-model="form.email"
                            label="Email"
                            placeholder="swift-ui@lover.com"
                            variant="primary"
                        />
                        <BaseInputError :text="form.errors?.email"/>

                    </div>
                    <BaseCheckbox
                        v-model="form.is_paid"
                        label="Is this a paid app?"
                        variant="primary"
                        class="mb-2"
                    >
                        <Tooltip
                            text="If your app is 100% free, you can leave this box unchecked. If you have at least 1 paid plan or feature, that means that your app is paid. All apps are regularly controlled to prevent scam."/>
                    </BaseCheckbox>
                    <BaseButton type="submit" class="w-full">Submit</BaseButton>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
