<script setup lang="ts">
    defineProps<{
        app: App.Resources.AppResource;
    }>();
</script>

<template>
    <a
        :href="app.url"
        class="flex items-center bg-base-100 rounded-xl shadow-xl p-2 cursor-pointer border border-primary border-1 w-72 2xl:w-80"
    >
        <div class="flex items-center">
            <img
                :src="app.logo_url"
                alt="logo"
                class="mr-2 w-[70px] aspect-square rounded-xl"
            />
            <div class="self-start ml-1">
                <p class="font-bold text-lg mb-1 text-gray-800">{{ app.title }}</p>
                <p class="text-xs text-gray-700 truncate-lines">{{ app.sentence }}</p>
            </div>
        </div>
    </a>
</template>

<style scoped>

</style>
