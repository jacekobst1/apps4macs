<script setup lang="ts">
    import {usePage} from '@inertiajs/vue3';
    import fireToast from "@/lib/toast";

    const {props} = usePage();

    if (props.flash?.alertSuccess) {
        fireToast('success', props.flash.alertSuccess);
    }
</script>
