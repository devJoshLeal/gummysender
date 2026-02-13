<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    templates: Array
})

const form = useForm({})

function restoreTemplate(id) {
    form.post(route('email-templates.restoretemplate', id), {
        preserveScroll: true
    })
}

function forceDeleteTemplate(id) {
    Swal.fire({
        title: 'Eliminar permanentemente?',
        text: 'Esta acción es irreversible.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('email-templates.force-delete', id), {
                preserveScroll: true
            })
        }
    })
}
</script>

<template>
    <AppLayout title="Papelera">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Papelera
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-6">
                    <Link 
                        :href="route('email-templates.index')" 
                        class="text-indigo-600 hover:underline"
                    >
                        ← Volver a plantillas
                    </Link>
                </div>

                <div v-if="templates.length === 0">
                    No hay plantillas en la papelera.
                </div>

                <div v-else class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div 
                        v-for="template in templates"
                        :key="template.id"
                        class="bg-white shadow rounded-xl p-6"
                    >
                        <h3 class="text-lg font-semibold">
                            {{ template.title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Eliminado el: {{ template.deleted_at }}
                        </p>

                        <div class="flex gap-4 mt-4">
                            <button
                                @click="restoreTemplate(template.id)"
                                class="text-green-600 hover:underline"
                            >
                                Restaurar
                            </button>

                            <button
                                @click="forceDeleteTemplate(template.id)"
                                class="text-red-600 hover:underline"
                            >
                                Eliminar definitivamente
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
