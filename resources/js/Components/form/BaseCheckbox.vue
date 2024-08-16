<script setup lang="ts">
    import {computed} from "vue";
    import BaseLabel from "@/Components/form/BaseLabel.vue";

    interface Props {
        variant?: "default" | "primary";
        size?: 'xs' | 'sm' | 'md' | 'lg';
        label?: string;
        tooltipText?: string;
    }

    const props = withDefaults(defineProps<Props>(), {
        variant: 'default',
        size: 'md',
        label: '',
        tooltipText: '',
    });

    const model = defineModel()

    const sizeClass = computed(() => {
        switch (props.size) {
            case "xs":
                return "checkbox-xs";
            case "sm":
                return "checkbox-xs md:checkbox-sm";
            case "md":
                return "checkbox-sm md:checkbox-md";
            case "lg":
                return "checkbox-md md:checkbox-lg";
            default:
                return "checkbox-sm md:checkbox-md";
        }
    });

    const inputClasses = computed(() => [
        ['checkbox rounded-lg', sizeClass.value],
        [
            {'': props.variant === "default"},
            {'checkbox-primary': props.variant === "primary"},
        ]
    ]);
</script>

<template>
    <div v-if="label" class="flex">
        <BaseLabel :text="label" :tooltip-text="tooltipText">
            <input
                type="checkbox"
                v-model="model"
                v-bind="$attrs"
                :class="inputClasses"
            />
        </BaseLabel>
    </div>

    <div v-else class="flex">
        <input
            type="checkbox"
            v-model="model"
            v-bind="$attrs"
            :class="inputClasses"
        />
    </div>
</template>
