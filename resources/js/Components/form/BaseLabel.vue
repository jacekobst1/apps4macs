<script setup lang="ts">
    import Tooltip from "@/Components/form/BaseTooltip.vue";

    const props = defineProps<{
        text: string,
        tooltipText?: string,
    }>();
</script>

<template>
    <label class="block">
        <span class="block text-xs md:text-sm font-medium select-none text-base-content px-1 mb-0.5">
            {{ props.text }}
            <Tooltip
                v-if="tooltipText"
                :text="tooltipText"
            />
        </span>
        <slot/>
    </label>
</template>
