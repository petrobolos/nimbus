<script setup>
import { computed } from 'vue';
import Shared from '../../Mixins/Styles/Shared';

const props = defineProps({
    active: {
        default: false,
        type: Boolean,
        required: false,
    },

    href: {
        type: String,
        required: true,
    },
});

const classes = computed(() => {
    const focus = Shared.focusOutlineNoOffset;
    const isActive = props.active ? 'active' : '';

    return `
        menu-item
        inline-flex items-center
        w-full px-4 py-2
        text-left text-white
        hover:bg-gray-800
        leading-5 text-white
        transition duration-150 ease-in-out
        ${focus}
        ${isActive}
    `;
});
</script>

<template>
    <Link :href="href" :class="classes" @click="$emit('click')">
        <slot />
    </Link>
</template>
