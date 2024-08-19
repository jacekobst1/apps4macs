<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    const form = useForm<{
        url: string,
        email: string,
        is_paid: boolean,
        price_type?: 'monthly' | 'yearly',
    }>({
        url: '',
        email: '',
        is_paid: false,
        price_type: undefined,
    });

    function postFree() {
        form.price_type = undefined;
        form.post('/sign-up')
    }

    function postPaidMonthly() {
        form.price_type = 'monthly';
        form.post('/sign-up')
    }

    function postPaidYearly() {
        form.price_type = 'yearly';
        form.post('/sign-up')
    }
</script>

<template>
    <Head title="Sign up"/>

    <StandardLayout>
        <div class="min-h-screen flex justify-center items-center md:-mt-16" :class="{ '-mt-16': !form.is_paid}">
            <div>
                <div class="w-full mb-6">
                    <h1 class="font-bold text-xl">Sign up</h1>
                </div>
                <form class="min-w-80 max-w-2xl">
                    <div class="mb-4">
                        <BaseInput
                            v-model="form.url"
                            label="App url"
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
                    <div v-if="form.is_paid" class="flex flex-col md:flex-row items-stretch">
                        <div
                            class="card flex flex-col w-full bg-base-100 border border-black sm:w-96 mb-4 md:mb-0 md:mr-4">
                            <div class="card-body flex-grow flex flex-col">
                                <h2 class="card-title mb-2 text-lg">Monthly plan</h2>
                                <div class="flex items-end mb-8">
                                    <span class="text font-semibold mr-1">8.99$</span>
                                    <span class="text-sm text-gray-500"> /month</span>
                                </div>
                                <div class="mb-4 flex flex-col">
                                    <span class="text-xs font-bold">What are you getting?</span>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Increased visibility and awareness</span>
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Targeted audience</span>
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Shown at top at least once a month</span>
                                    </label>
                                </div>
                                <div class="card-actions mt-auto justify-center">
                                    <BaseButton @click="postPaidMonthly" :disabled="form.processing" class="w-full">
                                        Buy now
                                    </BaseButton>
                                    <span class="text-xs text-gray-500 -mt-1">Cancel anytime</span>
                                </div>
                            </div>
                        </div>
                        <div class="card flex flex-col w-full bg-base-100 border border-black sm:w-96">
                            <div class="card-body flex-grow flex flex-col">
                                <h2 class="card-title mb-2 text-lg">Yearly plan</h2>
                                <div class="flex items-end">
                                    <span class="text font-semibold mr-1">69.99$</span>
                                    <span class="text-sm text-gray-500"> /year</span>
                                </div>
                                <span class="text-blue-400 -mt-3 mb-4">Save 35% annually</span>
                                <div class="mb-4 flex flex-col">
                                    <span class="text-xs font-bold">What are you getting?</span>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Increased visibility and awareness</span>
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Targeted audience</span>
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Shown at top at least once a month</span>
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            checked
                                            disabled
                                            class="checkbox checkbox-xs mr-1 !opacity-100"
                                        />
                                        <span class="text-xs">Most affordable price</span>
                                    </label>
                                </div>
                                <div class="card-actions mt-auto justify-center">
                                    <BaseButton @click="postPaidYearly" :disabled="form.processing" class="w-full">
                                        Buy now
                                    </BaseButton>
                                    <span class="text-xs text-gray-500 -mt-1">Cancel anytime</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <BaseButton v-else @click="postFree" :disabled="form.processing" class="w-full">
                        Submit
                    </BaseButton>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
