<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseCheckbox from "@/Components/form/BaseCheckbox.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import Pricing from "@/Components/Pricing.vue";

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

                    <Pricing
                        v-if="form.is_paid"
                        :post-paid-monthly="postPaidMonthly"
                        :post-paid-yearly="postPaidYearly"
                        :processing="form.processing"
                    />

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
