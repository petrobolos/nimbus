<script setup>
import { computed } from 'vue';
import { Shared } from '@/Mixins/Styles/Shared';

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

    isExternal: {
        default: false,
        required: false,
        type: Boolean,
    },
});

const classes = computed(() => {
    const focus = Shared.focusOutlineNoOffset;
    const base = `
        inline-flex items-center
        px-1 pt-1
        border-b-4 text-lg
        font-medium leading-5 text-white
        transition duration-150 ease-in-out
        ${focus}
    `;

    return props.active
        ? `${base} border-white`
        : `${base} border-transparent hover:border-white`;
});

</script>

<template>
    <div>
        <a v-if="isExternal" :href="href" :class="classes" target="_blank">
            <slot />
        </a>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
