<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import MainMenu from '@/Components/Navigation/MainMenu.vue';
import NavBar from '@/Components/Navigation/NavBar.vue';

const props = defineProps({
    title: {
        required: true,
        type: String,
    },
});

let menuIsOpen = ref(false);

/**
 * Toggles the navigation menu.
 * @returns {void}
 */
const toggleMenu = () => {
    menuIsOpen.value = !menuIsOpen.value;
};

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <Head :title="props.title" />

        <!-- Main Menu -->
        <MainMenu :is-open="menuIsOpen" @toggleMenu="toggleMenu" />

        <!-- Navbar -->
        <NavBar @toggleMenu="toggleMenu" />

        <!-- Content -->
        <main>
            <div class="w-full mx-auto sm:px-6 lg:px-8 pt-4">
                <slot />
            </div>
        </main>
    </div>
</template>
