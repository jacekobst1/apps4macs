<script setup lang="ts">
    const props = defineProps<{ text: string }>();

    defineOptions({
        inheritAttrs: false,
    })
</script>

<template>
    <label class="block">
    <span class="block text-xs md:text-sm font-medium select-none text-base-content px-1 mb-0.5">
      {{ props.text }}
    </span>
        <slot/>
    </label>
</template>
