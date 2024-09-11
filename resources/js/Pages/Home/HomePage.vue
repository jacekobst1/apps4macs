<script setup lang="ts">
    import {Link} from '@inertiajs/vue3';
    import {computed, ref} from "vue";
    import {useIntersectionObserver} from '@vueuse/core'
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import StandardLayout from "@/Layouts/StandardLayout.vue";
    import axios from "axios";
    import AppTile from "@/Components/shared/AppTile.vue";
    import {PageProps} from "@/types";

    const props = defineProps<PageProps<{
        apps: CursorPagination<App.Resources.AppResource>
    }>>();

    const search = ref('');
    const last = ref(null);
    const noMoreItems = ref(false);
    const isLoading = ref(false);
    const allApps = ref(props.apps.data);

    const loadData = () => {
        if (!props.apps.next_cursor) {
            noMoreItems.value = true;
            isLoading.value = false;
            return;
        }

        axios.get(`${props.apps.path}?cursor=${props.apps.next_cursor}`).then((response: any) => {
            allApps.value = [...allApps.value, ...response.data.data];
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
        }).catch(() => {
            isLoading.value = false;
        });
    };

    const {stop} = useIntersectionObserver(
        last,
        ([{isIntersecting}]) => {
            if (isIntersecting && !isLoading.value && !noMoreItems.value) {
                isLoading.value = true;
                setTimeout(loadData, 250)
            }
        },
        {threshold: 0.5}
    );

    const submitAppLink = computed(() => props.auth.user ? '/new-app/specify-if-paid' : '/sign-up');
</script>

<template>
    <StandardLayout>
        <div class="mb-8 pt-6">
            <div class="text-sm sm:text-lg mb-4 text-gray-500">
                <p>The coolest apps for devs and other geeks</p>
                <p>Maintained by humans. No trash</p>
            </div>
            <Link :href="submitAppLink">
                <BaseButton class="shadow-2xl">
                    <v-icon name="co-plus" class="mr-2"/>
                    Submit new app
                </BaseButton>
            </Link>
        </div>

        <!--        <div class="flex justify-center mb-8">-->
        <!--            <BaseInput v-model="search" class="w-full shadow-xl" placeholder='Search...' variant="primary"/>-->
        <!--        </div>-->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 xl:gap-6 mb-10">
            <template v-for="app in allApps" :key="app.id">
                <AppTile :app="app" class="justify-self-center"/>
            </template>
        </div>
        <div v-if="!noMoreItems" ref="last" class="h-10"></div>
        <div v-if="isLoading && !noMoreItems" class="mb-10 text-center font-bold">
            <span>Loading more items...</span>
        </div>
    </StandardLayout>
</template>

<style scoped>

</style>
