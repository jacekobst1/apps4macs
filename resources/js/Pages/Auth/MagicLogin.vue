<script setup lang="ts">
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import {Head, router} from "@inertiajs/vue3";
    import {reactive} from 'vue'
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import BaseInputError from "@/Components/form/BaseInputError.vue";

    defineProps({
        errors: Object
    })

    const form = reactive({
        email: null,
    })

    function submit() {
        router.post('/login', form)
    }
</script>

<template>
    <Head title="Login"/>

    <GuestLayout class="pt-0">
        <div class="w-fit h-screen self-center flex flex-col justify-center">
            <div class="w-full mb-6">
                <h1 class="font-bold text-xl">Login</h1>
            </div>
            <form @submit.prevent="submit" class="min-w-80 max-w-lg">
                <div class="mb-4">
                    <BaseInput
                        v-model="form.email"
                        label="Email"
                        placeholder="swift-ui@lover.com"
                        variant="primary"
                    />
                    <BaseInputError :text="errors?.email"/>
                </div>
                <BaseButton type="submit" class="w-full">Send me login link</BaseButton>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
