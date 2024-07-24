<script setup lang="ts">
    interface Props {
        text: string,
    }

    const props = defineProps<Props>();
</script>

<template>
    <div class="tooltip" :data-tip="props.text">
        <v-icon name="oi-info"/>
    </div>
</template>

<style scoped>

</style>
