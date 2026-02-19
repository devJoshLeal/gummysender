<script setup>
import { ref, onMounted } from 'vue'
const props=defineProps({
    template: Array,
    blueprint: String
})
const htmlContent = ref('')

onMounted(async () => {
    const response = await fetch('/blueprints/html/'+props.blueprint+'.html')
    htmlContent.value = await response.text()
})
</script>

<template>
    <div v-html="htmlContent"></div>
</template>
