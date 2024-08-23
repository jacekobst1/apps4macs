<script setup lang="ts">
    import {usePage} from '@inertiajs/vue3';
    import fireToast from "@/lib/toast";

    const page = usePage()

    if (page.props?.flash?.alertSuccess) {
        fireToast('success', page.props.flash.alertSuccess);
    }
</script>
