<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    template: Object
})

const form = useForm({
    title: props.template.title,
    subject: props.template.subject,
    content_html: props.template.content_html,
})
</script>

<template>
    <AppLayout :title="`Editar - ${template.title}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Plantilla
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">

                    <form @submit.prevent="form.put(route('email-templates.update', template.id))">
                        
                        <!-- Nombre -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1">Nombre</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="w-full border rounded p-2"
                            />
                            <div v-if="form.errors.title" class="text-red-500 text-sm">
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1">Asunto</label>
                            <input
                                v-model="form.subject"
                                type="text"
                                class="w-full border rounded p-2"
                            />
                            <div v-if="form.errors.subject" class="text-red-500 text-sm">
                                {{ form.errors.subject }}
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1">Contenido</label>
                            <textarea
                                v-model="form.content_html"
                                rows="8"
                                class="w-full border rounded p-2"
                            ></textarea>
                            <div v-if="form.errors.content_html" class="text-red-500 text-sm">
                                {{ form.errors.content_html }}
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-between items-center mt-6">
                            <Link
                                :href="route('email-templates.show', template.id)"
                                class="text-gray-600 hover:underline"
                            >
                                Cancelar
                            </Link>

                            <button
                                type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                                :disabled="form.processing"
                            >
                                Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
