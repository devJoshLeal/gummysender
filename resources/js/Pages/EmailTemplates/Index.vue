<script setup>
defineProps({
    templates: Array
})
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Email Templates
        </h1>

        <div v-if="templates.length === 0">
            No templates yet.
        </div>

        <div v-else class="space-y-3">
            <div 
                v-for="template in templates" 
                :key="template.id"
                class="p-4 border rounded"
            >
                <h2 class="font-semibold">
                    {{ template.title }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ template.subject }}
                </p>
                <p class="text-xs text-gray-400">
                    Created by: {{ template.author?.name }}
                </p>
            </div>
        </div>
    </div>
</template>
