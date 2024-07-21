<script setup lang="ts">
    import {computed} from "vue";

    interface Props {
        size?: 'xs' | 'sm' | 'md' | 'lg';
        placeholder?: string;
    }

    const props = withDefaults(defineProps<Props>(), {
        size: 'md',
        placeholder: '',
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

</script>

<template>
    <input
        v-model="model"
        v-bind="$attrs"
        class="input w-full rounded-xl"
        :class="sizeClass"
        :placeholder="props.placeholder"
    />
</template>
