<script setup lang="ts">
    import {Head, useForm} from "@inertiajs/vue3";
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";

    defineProps({
        errors: Object
    })

    const form = useForm({
        email: null,
    })

    function makeRequest() {
        form.post('/login');
    }
</script>

<template>
    <Head title="Login"/>

    <StandardLayout>
        <div class="min-h-screen flex justify-center items-center -top-16 relative">
            <div>
                <div class="w-full mb-6">
                    <h1 class="font-bold text-xl">Login</h1>
                </div>
                <form @submit.prevent="makeRequest" class="min-w-80 max-w-lg">
                    <div class="mb-4">
                        <BaseInput
                            v-model="form.email"
                            label="Email"
                            placeholder="swift-ui@lover.com"
                            variant="primary"
                        />
                        <BaseInputError :text="errors?.email"/>
                    </div>
                    <BaseButton :disabled="form.processing" type="submit" class="w-full">Send me login link</BaseButton>
                </form>
            </div>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
