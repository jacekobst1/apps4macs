<script setup lang="ts">
    interface Props {
        text?: string
    }

    const props = defineProps<Props>();
</script>

<template>
    <span v-if="text" class="text-red-700 text-sm ml-1">{{ text }}</span>

</template>

<style scoped>

</style>
