<script setup lang="ts">
    import {Head, Link} from '@inertiajs/vue3';
    import {ref} from "vue";
    import {useIntersectionObserver} from '@vueuse/core'
    import BaseInput from "@/Components/form/BaseInput.vue";
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import axios from "axios";
    import AppTile from "@/Components/AppTile.vue";

    const props = defineProps<{
        auth: Record<string, any>;
        apps: CursorPagination<App.Resources.AppResource>;
    }>();

    const search = ref('');
    const last = ref(null);
    const noMoreItems = ref(false);
    const isLoading = ref(false);

    const loadData = () => {
        axios.get(`${props.apps.path}?cursor=${props.apps.next_cursor}`).then((response: any) => {
            props.apps.data = [...props.apps.data, ...response.data.data];
            props.apps.next_cursor = response.data.next_cursor;
            props.apps.next_page_url = response.data.next_page_url;
            props.apps.path = response.data.path;
            props.apps.prev_cursor = response.data.prev_cursor;
            props.apps.prev_page_url = response.data.prev_page_url;

            isLoading.value = false;

            if (!response.data.next_cursor) {
                noMoreItems.value = true;
                stop();
            }
        })
    };

    const {stop} = useIntersectionObserver(
        last,
        ([{isIntersecting}]) => {
            if (isIntersecting) {
                isLoading.value = true;
                setTimeout(loadData, 250)
            }
        }
    );
</script>

<template>
    <Head title="List"/>

    <StandardLayout>
        <div class="mb-8 pt-6">
            <!--            <ApplicationLogo width="150px" height="150px"/>-->
            <h1 class="text-lg sm:text-2xl font-bold mb-2 sm:md-4">apps4macs</h1>
            <div class="text-sm sm:text-lg mb-4 text-gray-500">
                <p>No-brainer apps for devs and powerusers</p>
                <p>Verified and maintained by "HumanIntelligence"</p>
            </div>
            <Link :href="auth?.user ? '/new-app/specify-if-paid' : '/sign-up'">
                <BaseButton class="shadow-2xl">
                    <v-icon name="co-plus" class="mr-2"/>
                    Submit new app
                </BaseButton>
            </Link>
        </div>

        <div class="flex justify-center mb-8">
            <BaseInput v-model="search" class="w-full shadow-xl" placeholder='Search...' variant="primary"/>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 xl:gap-6 mb-10">
            <template v-for="app in apps.data" :key="app.id">
                <AppTile :app="app" class="justify-self-center"/>
            </template>
        </div>
        <div ref="last" class="-translate-y-32"></div>
        <div v-if="isLoading" class="mb-10 text-center font-bold">
            <span>Loading more items...</span>
        </div>
    </StandardLayout>
</template>

<style scoped>
    .truncate-lines {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
