<script setup lang="ts">
    import BaseButton from "@/Components/buttons/BaseButton.vue";

    defineProps<{
        processing: boolean,
        postPaidMonthly: () => void,
        postPaidYearly: () => void,
    }>();
</script>

<template>
    <div class="flex flex-col md:flex-row items-stretch">
        <div
            class="card flex flex-col w-full bg-base-100 border border-black sm:w-96 mb-4 md:mb-0 md:mr-4">
            <div class="card-body flex-grow flex flex-col">
                <h2 class="card-title mb-2 text-lg">Monthly plan</h2>
                <div class="flex items-end mb-8">
                    <span class="text font-semibold mr-1">$8.99</span>
                    <span class="text-sm text-gray-500"> /month</span>
                </div>
                <div class="mb-4 flex flex-col">
                    <span class="text-xs font-bold">What are you getting?</span>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Increased visibility and awareness</span>
                    </label>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Targeted audience</span>
                    </label>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Shown at top at least once a month</span>
                    </label>
                </div>
                <div class="card-actions mt-auto justify-center">
                    <BaseButton @click="postPaidMonthly()" :disabled="processing" class="w-full">
                        Buy now
                    </BaseButton>
                    <span class="text-xs text-gray-500 -mt-1">Cancel anytime</span>
                </div>
            </div>
        </div>
        <div class="card flex flex-col w-full bg-base-100 border border-black sm:w-96">
            <div class="card-body flex-grow flex flex-col">
                <h2 class="card-title mb-2 text-lg">Yearly plan</h2>
                <div class="flex items-end">
                    <span class="text font-semibold mr-1">$69.99</span>
                    <span class="text-sm text-gray-500"> /year</span>
                </div>
                <span class="text-blue-400 -mt-3 mb-4">Save 35% annually</span>
                <div class="mb-4 flex flex-col">
                    <span class="text-xs font-bold">What are you getting?</span>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Increased visibility and awareness</span>
                    </label>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Targeted audience</span>
                    </label>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Shown at top at least once a month</span>
                    </label>
                    <label>
                        <input
                            type="checkbox"
                            checked
                            disabled
                            class="checkbox checkbox-xs mr-1 !opacity-100"
                        />
                        <span class="text-xs">Most affordable price</span>
                    </label>
                </div>
                <div class="card-actions mt-auto justify-center">
                    <BaseButton @click="postPaidYearly()" :disabled="processing" class="w-full">
                        Buy now
                    </BaseButton>
                    <span class="text-xs text-gray-500 -mt-1">Cancel anytime</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
