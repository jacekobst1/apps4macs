<script setup lang="ts">
    import {computed} from "vue";
    import BaseLabel from "@/Components/form/BaseLabel.vue";

    interface Props {
        variant?: "default" | "primary";
        size?: 'xs' | 'sm' | 'md' | 'lg';
        placeholder?: string;
        label?: string;
        error?: string;
    }

    const props = withDefaults(defineProps<Props>(), {
        variant: 'default',
        size: 'md',
        placeholder: '',
        label: '',
        error: '',
    });

    const model = defineModel<string | null>()

    const sizeClass = computed(() => {
        switch (props.size) {
            case "xs":
                return "textarea-xs";
            case "sm":
                return "textarea-xs md:textarea-sm";
            case "md":
                return "textarea-sm md:textarea-md";
            case "lg":
                return "textarea-md md:textarea-lg";
            default:
                return "textarea-sm md:textarea-md";
        }
    });

    const textareaClasses = computed(() => [
        ['textarea w-full', sizeClass.value],
        [
            {'': props.variant === "default"},
            {'textarea-primary': props.variant === "primary"},
        ]
    ]);
</script>

<template>
    <template v-if="label">
        <BaseLabel :text="label">
            <textarea
                v-model="model"
                v-bind="$attrs"
                :class="textareaClasses"
                :placeholder="placeholder"
            />
        </BaseLabel>
    </template>

    <template v-else>
        <textarea
            v-model="model"
            v-bind="$attrs"
            :class="textareaClasses"
            :placeholder="placeholder"
        />
    </template>
</template>
