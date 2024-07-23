<script setup lang="ts">
    import BaseButton from "@/Components/buttons/BaseButton.vue";
    import {Link} from '@inertiajs/vue3';

    interface LinkButtonProps {
        href: string;
    }

    const props = withDefaults(defineProps<LinkButtonProps>(), {
        href: "",
    });
</script>

<template>
    <Link :href="href">
        <BaseButton>
            <slot/>
        </BaseButton>
    </Link>
</template>
