<script setup>
import { computed } from 'vue';
import Shared from '@/Mixins/Styles/Shared';

const logoClasses = computed(() => {
    const focus = Shared.focusOutlineNoOffset;

    return `
        text-2xl text-white
        ${focus}
    `;
});

const userButtonClasses = computed(() => {
    const focus = Shared.focusOutlineNoOffset;

    return `
        flex items-center
        text-lg font-medium text-white
        hover:text-gray-300
        transition duration-150 ease-in-out
        ${focus}
    `;
});
</script>

<template>
    <nav class="bg-nimbus-primary">
        <!-- Navigation menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a :class="logoClasses" :href="route('dashboard')">
                            Nimbus
                        </a>
                    </div>
                </div>

                <!-- Settings dropdown -->
                <div class="flex items-center ml-6">
                    <button :class="userButtonClasses" @click="$emit('toggleMenu')">
                        Menu
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>
