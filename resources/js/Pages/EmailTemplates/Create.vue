<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    subject: '',
    title: '',
    content_html: ''
})

const submit = () => {
    form.post(route('email-templates.store'))
}
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Email Template
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="submit" class="space-y-4">

                <div>
                    <label class="block font-medium">Subject</label>
                    <input 
                        v-model="form.subject"
                        type="text"
                        class="w-full border rounded p-2"
                    />
                    <div v-if="form.errors.subject" class="text-red-500 text-sm">
                        {{ form.errors.subject }}
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Title</label>
                    <input 
                        v-model="form.title"
                        type="text"
                        class="w-full border rounded p-2"
                    />
                    <div v-if="form.errors.title" class="text-red-500 text-sm">
                        {{ form.errors.title }}
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Content</label>
                    <textarea 
                        v-model="form.content_html"
                        rows="6"
                        class="w-full border rounded p-2"
                    ></textarea>
                    <div v-if="form.errors.content_html" class="text-red-500 text-sm">
                        {{ form.errors.content_html }}
                    </div>
                </div>

                <div class="flex gap-4">
                    <button 
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                        :disabled="form.processing"
                    >
                        Save
                    </button>

                    <Link 
                        :href="route('email-templates.index')"
                        class="text-gray-600"
                    >
                        Cancel
                    </Link>
                </div>

            </form>
        </div>
    </AppLayout>
</template>
