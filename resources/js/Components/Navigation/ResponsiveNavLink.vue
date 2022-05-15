<script setup>
import { computed } from 'vue';
import { Shared } from '@/Mixins/Styles/Shared';

defineProps({
    active: {
        default: false,
        type: Boolean,
        required: false,
    },

    href: {
        default: '#',
        type: String,
        required: false,
    },

    as: {
        default: '',
        type: String,
        required: false,
    },
});

const isButton = computed(() => {
   return as.toLowerCase() === 'button';
});

const classes = computed(() => {
    const focus = Shared.focusOutlineNoOffset;
    const base = `block pl-3 pr-4 py-2 text-base font-medium transition duration-150 ease-in-out ${focus}`;

    return active
        ? `${base} text-black bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700`
        : `${base} text-white hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 focus:outline-none`;
});
</script>

<template>
    <div>
        <button v-if="isButton" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
