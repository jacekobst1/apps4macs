<script setup lang="ts">
    import {computed} from "vue";
    import BaseLabel from "@/Components/form/BaseLabel.vue";

    defineOptions({
        inheritAttrs: false,
    })

    interface Props {
        variant?: "default" | "primary";
        size?: 'xs' | 'sm' | 'md' | 'lg';
        placeholder?: string;
        label?: string;
        error?: string;
        tooltipText?: string;
    }

    const props = withDefaults(defineProps<Props>(), {
        variant: 'default',
        size: 'md',
        placeholder: '',
        label: '',
        error: '',
        tooltipText: '',
    });

    const model = defineModel()

    const sizeClass = computed(() => {
        switch (props.size) {
            case "xs":
                return "input-xs";
            case "sm":
                return "input-xs md:input-sm";
            case "md":
                return "input-sm md:input-md";
            case "lg":
                return "input-md md:input-lg";
            default:
                return "input-sm md:input-md";
        }
    });

    const inputClasses = computed(() => [
        ['input w-full', sizeClass.value],
        [
            {'': props.variant === "default"},
            {'input-primary': props.variant === "primary"},
        ]
    ]);
</script>

<template>
    <template v-if="label">
        <BaseLabel :text="label" :tooltip-text="tooltipText">
            <input
                v-model="model"
                v-bind="$attrs"
                :class="inputClasses"
                :placeholder="placeholder"
            />
        </BaseLabel>
    </template>

    <template v-else>
        <input
            v-model="model"
            v-bind="$attrs"
            :class="inputClasses"
            :placeholder="placeholder"
        />
    </template>
</template>
