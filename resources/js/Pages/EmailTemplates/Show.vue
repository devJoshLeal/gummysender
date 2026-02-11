<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    template: Object
});
</script>

<template>
    <AppLayout :title="`Template - ${template.name}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ver Template
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Nombre:</h3>
                        <p>{{ template.title }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Asunto:</h3>
                        <p>{{ template.subject }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold">Contenido:</h3>
                        <div class="border p-4 mt-2 bg-gray-50 rounded">
                            <div v-html="template.content_html"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
