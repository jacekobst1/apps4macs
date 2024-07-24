<script setup lang="ts">
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import {Head, router} from "@inertiajs/vue3";
    import {reactive} from 'vue'
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
    import Tooltip from "@/Components/form/BaseTooltip.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";

    defineProps({
        errors: Object
    })

    const form = reactive({
        url: null,
        email: null,
        isPaid: false,
    })

    function submit() {
        router.post('/submit-app', form)
    }
</script>

<template>
    <Head title="Submit app"/>

    <GuestLayout class="pt-0">
        <div class="w-fit h-screen self-center flex flex-col justify-center">
            <div class="w-full mb-6">
                <h1 class="font-bold text-xl">Submit your app</h1>
            </div>
            <form @submit.prevent="submit" class="min-w-80 max-w-lg">
                <div class="mb-4">
                    <BaseInput
                        v-model="form.url"
                        label="Url"
                        placeholder="https://super-cool-landing-page.com"
                        variant="primary"
                    />
                    <BaseInputError :text="errors?.url"/>
                </div>
                <div class="mb-4">
                    <BaseInput
                        v-model="form.email"
                        label="Email"
                        placeholder="swift-ui@lover.com"
                        variant="primary"
                    />
                    <BaseInputError :text="errors?.email"/>

                </div>
                <BaseCheckbox
                    v-model="form.isPaid"
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
    </GuestLayout>
</template>

<style scoped>

</style>
