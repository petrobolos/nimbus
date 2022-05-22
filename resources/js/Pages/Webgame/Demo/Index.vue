<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    game: {
        required: true,
        type: Object,
    },

    difficulty: {
        required: true,
        type: String,
    },
});
</script>

<template>
    <AppLayout title="Demo">
        <div class="py-12">
            {{ props }}
        </div>
    </AppLayout>
</template>
