<script setup lang="ts">
    import {ref} from "vue";
    import Config from "../../config";

    const dialog = ref<HTMLDialogElement>();

    const visible = ref(false);

    const showModal = () => {
        dialog.value?.showModal();
        visible.value = true;
    };
</script>

<template>
    <v-icon
        name="ci-chat"
        @click="showModal()"
        class="w-16 h-16 fixed z-50 cursor-pointer
               bottom-2 md:bottom-10 right-2
               hover:scale-110 transition-transform duration-300"
        :class="visible ? 'md:right-14' : 'md:right-10'"
    />

    <dialog ref="dialog" @close="visible = false" class="modal">
        <div class="modal-box">
            <h3 class="text-lg">Want to leave some feedback? Or just chat? 🤓</h3>
            <div class="flex flex-col md:flex-row md:items-center pt-4">
                <p class="mr-2">Contact me at:</p>
                <a :href="'mailto:' + Config.contactMail" class="text-lg font-bold hover:underline outline-none">
                    {{ Config.contactMail }}
                </a>
            </div>
        </div>

        <form v-if="visible" method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>

<style scoped>

</style>
