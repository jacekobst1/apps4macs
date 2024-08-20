<script setup lang="ts">
    import {computed} from 'vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import PrimaryButton from "@/Components/breeze/PrimaryButton.vue";

    const props = defineProps<{
        status?: string;
    }>();

    const form = useForm({});

    const submit = () => {
        form.post(route('verification.send'));
    };

    const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <!--    <GuestLayout>-->
    <!--        <Head title="Email Verification" />-->

    <!--        <div class="mb-4 text-sm text-gray-600">-->
    <!--            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link-->
    <!--            we just emailed to you? If you didn't receive the email, we will gladly send you another.-->
    <!--        </div>-->

    <!--        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">-->
    <!--            A new verification link has been sent to the email address you provided during registration.-->
    <!--        </div>-->

    <!--        <form @submit.prevent="submit">-->
    <!--            <div class="mt-4 flex items-center justify-between">-->
    <!--                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
    <!--                    Resend Verification Email-->
    <!--                </PrimaryButton>-->

    <!--                <Link-->
    <!--                    :href="route('logout')"-->
    <!--                    method="post"-->
    <!--                    as="button"-->
    <!--                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
    <!--                    >Log Out</Link-->
    <!--                >-->
    <!--            </div>-->
    <!--        </form>-->
    <!--    </GuestLayout>-->
    <Head title="Email verification"/>

    <GuestLayout>
        <div class="w-fit h-screen self-center flex flex-col justify-center">
            <div class="card bg-white shadow-xl rounded-xl">
                <div class="card-body">
                    <v-icon name="io-mail-unread-outline" class="w-24 h-24"/>
                    <h2 class="card-title">Verify your email first</h2>
                    <p>
                        Thanks for signing up! Before submitting your app, please verify your email address by clicking
                        on the link we just emailed to you (check also spam folder).
                    </p>
                    <p>
                        If you didn't receive the email, click the button below.
                    </p>

                    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Resend Verification Email
                            </PrimaryButton>

                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >Log Out
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
