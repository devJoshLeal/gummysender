<script setup>
defineProps({
    html: String,
    blueprint: String,
    template: Object
})
</script>

<template>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">
            Preview: {{ blueprint }}
        </h1>

        <iframe
            v-if="html"
            :srcdoc="html"
            class="w-full h-[700px] border rounded-lg bg-white"
        />
    </div>
</template>
