<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    templates: Array
})

const form = useForm({})

function confirmDelete(id) {
    Swal.fire({
        title: '¿Eliminar plantilla?',
        text: 'Esta acción no se puede deshacer (o si?).',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('email-templates.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'La plantilla fue eliminada correctamente.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    })
                }
            })
        }
    })
}
</script>


<template>
    <AppLayout title="Email Templates - Index">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Email Templates
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!--Create new email template button-->
                <div class="flex justify-start mb-6 my-3">
                    <Link 
                        :href="route('email-templates.create')" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                    >
                        + New Template
                    </Link>
                </div>
                <div v-if="templates.length === 0">
                    No templates yet.
                </div>

                <div v-else class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div 
                        v-for="template in templates" 
                        :key="template.id"
                        class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ template.title }}
                        </h3>

                        <p class="text-sm text-gray-600 mt-1">
                            {{ template.subject }}
                        </p>
                        <div 
                            
                            class="flex gap-4 mt-6"
                        >
                            <Link 
                                :href="route('email-templates.show', template.id)"
                                class="text-blue-600 hover:underline"
                            >
                                Ver
                            </Link>
                            <Link
                                v-if="$page.props.auth.user.id === template.author.id"
                                :href="route('email-templates.edit', template.id)"
                                class="text-indigo-600 hover:underline"
                            >
                                Editar
                            </Link>

                            <button v-if="$page.props.auth.user.id === template.author.id"
                                @click="confirmDelete(template.id)"
                                class="text-red-600 hover:underline"
                            >
                                Eliminar
                            </button>
                        </div>
                        <div class="mt-4 text-xs text-gray-400">
                            <span>
                                Created by: {{ template.author?.name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start mb-6 my-3">
                    <Link 
                        :href="route('email-templates.create')" 
                        class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition"
                    >
                        Papelera de Reciclaje
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
