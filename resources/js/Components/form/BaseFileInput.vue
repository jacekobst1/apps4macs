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

    const model = defineModel()

    const sizeClass = computed(() => {
        switch (props.size) {
            case "xs":
                return "file-input-xs";
            case "sm":
                return "file-input-xs md:file-input-sm";
            case "md":
                return "file-input-sm md:file-input-md";
            case "lg":
                return "file-input-md md:file-input-lg";
            default:
                return "file-input-sm md:file-input-md";
        }
    });

    const fileInputClasses = computed(() => [
        ['file-input w-full', sizeClass.value],
        [
            {'': props.variant === "default"},
            {'file-input-primary': props.variant === "primary"},
        ]
    ]);
</script>

<template>
    <template v-if="label">
        <BaseLabel :text="label">
            <input
            <!--                v-model="model"-->
            v-bind="$attrs"
            :class="fileInputClasses"
            :placeholder="placeholder"
            type="file"
            />
        </BaseLabel>
    </template>

    <template v-else>
        <input
        <!--            v-model="model"-->
        v-bind="$attrs"
        :class="fileInputClasses"
        :placeholder="placeholder"
        type="file"
        />
    </template>
</template>
