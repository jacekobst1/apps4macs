<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
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

    <StandardLayout>
        <div class="min-h-screen flex justify-center items-center -top-16 relative">
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
                        tooltip-text="If your app is 100% free, you can leave this box unchecked. If you have at least 1 paid plan or feature, that means that your app is paid. All apps are regularly controlled to prevent scam."
                    />
                    <div v-if="form.is_paid" class="flex flex-col sm:flex-row items-center">
                        <div class="card bg-base-100 border border-black w-full sm:w-64 mb-4 sm:mb-0 sm:mr-4">
                            <div class="card-body">
                                <h2 class="card-title mb-2 text-lg">Monthly plan</h2>
                                <div class="flex items-end mb-2">
                                    <span class="text font-semibold mr-1">7.99$</span>
                                    <span class="text-sm text-gray-500"> /mo</span>
                                </div>
                                <div class="card-actions justify-end">
                                    <BaseButton size="sm">Buy now</BaseButton>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-base-100 border border-black w-full sm:w-64">
                            <div class="card-body">
                                <h2 class="card-title mb-2 text-lg">Yearly plan</h2>
                                <div class="flex items-end">
                                    <span class="text font-semibold mr-1">59.99$</span>
                                    <span class="text-sm text-gray-500"> /yr</span>
                                </div>
                                <span class="text-blue-400 -mt-3 mb-2">Save 30% annually</span>
                                <div class="card-actions justify-end">
                                    <BaseButton size="sm">Buy now</BaseButton>
                                </div>
                            </div>
                        </div>
                    </div>
                    <BaseButton v-else :disabled="form.processing" type="submit" class="w-full">Submit</BaseButton>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
