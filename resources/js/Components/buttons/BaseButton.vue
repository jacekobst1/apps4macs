<script setup lang="ts">
    import {computed} from 'vue';

    interface ButtonProps {
        disabled?: boolean;
        isLoading?: boolean;
        isDarkBg?: boolean;
        variant?: "default" | "neutral" | "primary" | "secondary" | "accent" | "ghost" | "link" | "info" | "success" | "warning" | "error" | "outline" | "outline-primary" | "outline-secondary" | "outline-accent" | "outline-info" | "outline-success" | "outline-warning" | "outline-error";
        size?: "xs" | "sm" | "md" | "lg";
    }

    const props = withDefaults(defineProps<ButtonProps>(), {
        variant: "primary",
        size: "md",
    });

    const disabled = computed(() => props.isLoading || props.disabled);

    const sizeClass = computed(() => {
        switch (props.size) {
            case "xs":
                return "btn-xs";
            case "sm":
                return "btn-xs md:btn-sm";
            case "md":
                return "btn-sm md:btn-md";
            case "lg":
                return "btn-md md:btn-lg";
            default:
                return "btn-sm md:btn-md";
        }
    });

    const buttonClasses = computed(() => [
        ['btn', sizeClass.value],
        [
            {'': props.variant === "default"},
            {'btn-neutral bg-neutral': props.variant === "neutral"},
            {'btn-primary bg-primary': props.variant === "primary"},
            {'btn-secondary bg-secondary': props.variant === "secondary"},
            {'btn-accent bg-accent': props.variant === "accent"},
            {'btn-ghost bg-ghost': props.variant === "ghost"},
            {'btn-link bg-link': props.variant === "link"},
            {'btn-info bg-info': props.variant === "info"},
            {'btn-success bg-success': props.variant === "success"},
            {'btn-warning bg-warning': props.variant === "warning"},
            {'btn-error bg-error': props.variant === "error"},
            {'btn-outline': props.variant === "outline"},
            {'btn-outline btn-primary': props.variant === "outline-primary"},
            {'btn-outline btn-secondary': props.variant === "outline-secondary"},
            {'btn-outline btn-accent': props.variant === "outline-accent"},
            {'btn-outline btn-info': props.variant === "outline-info"},
            {'btn-outline btn-success': props.variant === "outline-success"},
            {'btn-outline btn-warning': props.variant === "outline-warning"},
            {'btn-outline btn-error': props.variant === "outline-error"},
        ]
    ]);
</script>

<template>
    <button
        type="button"
        :disabled="disabled"
        :class="[
            buttonClasses,
            {'btn-disabled': disabled},
        ]"
    >
    <span :class="{'invisible': isLoading}" class="flex items-center">
      <slot></slot>
    </span>
        <span v-if="isLoading" class="loading absolute"></span>
    </button>
</template>
