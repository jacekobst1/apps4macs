<script setup lang="ts">
    import {ref} from 'vue';
    import Dropdown from '@/Components/breeze/Dropdown.vue';
    import DropdownLink from '@/Components/breeze/DropdownLink.vue';
    import ResponsiveNavLink from '@/Components/breeze/ResponsiveNavLink.vue';
    import {Link} from '@inertiajs/vue3';
    import Alert from "@/Components/shared/Alert.vue";

    const showingNavigationDropdown = ref(false);

    function hideDropdown() {
        showingNavigationDropdown.value = false;
    }
</script>

<template>
    <Alert/>
    <div>
        <div class="min-h-screen bg-gray-100">
            <div class="container mx-auto flex flex-col sm-justify-center px-4 sm:px-6 lg:px-8">
                <nav class="border-b border-gray-100 z-50">
                    <!-- Primary Navigation Menu -->
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('home')" class="flex items-center">
                                        <img
                                            src="/apps4macs_logo_wo_square.png"
                                            alt="App logo"
                                            class="w-12 h-12 mr-1"
                                        />
                                        <span class="text-lg font-semibold">apps4macs</span>
                                        <!--                                        <ApplicationLogo-->
                                        <!--                                            class="block h-9 w-auto fill-current text-gray-800"-->
                                        <!--                                        />-->
                                    </Link>
                                </div>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                                <Link
                                    v-if="!$page.props.auth?.user"
                                    :href="route('login')"
                                    class="text-black transition hover:text-black/70"
                                >
                                    Log in
                                </Link>

                                <div v-else class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('my-apps.index')">My apps</DropdownLink>
                                            <DropdownLink :href="route('billing-portal')">Billing</DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <Link
                                v-if="!$page.props.auth?.user"
                                :href="route('login')"
                                class="sm:hidden self-center text-black transition hover:text-black/70"

                            >
                                Log in
                            </Link>

                            <div v-else class="-me-2 flex items-center sm:hidden">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                >
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path
                                            :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex': !showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex': showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <!--                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
                            <!--                                Dashboard-->
                            <!--                            </ResponsiveNavLink>-->
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="mt-3 space-y-1">
                                <span class="pl-4 text-gray-400">{{ $page.props.auth.user?.name }}</span>
                                <ResponsiveNavLink :href="route('my-apps.index')">My apps</ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('billing-portal')">Billing</ResponsiveNavLink>
                                <ResponsiveNavLink @click="hideDropdown" :href="route('logout')" method="post"
                                                   as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header class="shadow rounded-xl mb-5" v-if="$slots.header">
                    <div class="py-4 px-4 sm:px-6 lg:px-8">
                        <slot name="header"/>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot/>
                </main>
            </div>
        </div>
    </div>
</template>
