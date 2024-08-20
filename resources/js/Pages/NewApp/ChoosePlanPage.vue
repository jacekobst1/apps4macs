<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import Pricing from "@/Components/Pricing.vue";

    const props = defineProps<{
        is_paid: boolean,
    }>();

    const form = useForm<{
        is_paid: boolean,
        price_type?: 'monthly' | 'yearly',
    }>({
        is_paid: props.is_paid,
        price_type: undefined,
    });

    function postPaidMonthly() {
        form.price_type = 'monthly';
        form.post('/new-app/choose-plan')
    }

    function postPaidYearly() {
        form.price_type = 'yearly';
        form.post('/new-app/choose-plan')
    }
</script>

<template>
    <Head title="Specify if paid"/>

    <StandardLayout>
        <div class="min-h-screen flex justify-center items-center -mt-16">
            <pricing
                :post-paid-monthly="postPaidMonthly"
                :post-paid-yearly="postPaidYearly"
                :processing="form.processing"
            />
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
