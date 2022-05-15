<script setup>
import { computed } from 'vue';

const props = defineProps({
    width: {
        default: 'full',
        type: String,
        required: false,
    },

    responsive: {
        default: true,
        type: Boolean,
        required: false,
    },
});

const widths = {
    '1/12': "col-span-1",
    '1/6': "col-span-2",
    '1/4': "col-span-3",
    '1/3': "col-span-4",
    '5/12': "col-span-5",
    '1/2': "col-span-6",
    '7/12': "col-span-7",
    '2/3': "col-span-8",
    '3/4': "col-span-9",
    '5/6': "col-span-10",
    '11/12': "col-span-11",
    'full': "col-span-12",
};

const widthClasses = computed(() => {
    const bps = 'sm md lg xl'.split(' ');
    let classes = '';
    let bp, size;
    let hasBase = false;

    if (this.props.width.value.includes(':')) {
        const widths = this.props.width.value.split(' ');

        for (let i = 0; i < widths.length; i++) {
            if (widths[i].includes(':')) {
                [bp, size] = widths[i].split(':');

                if (size && bps.includes(bp)) {
                    const className = widths[size];
                    classes += (className ? `${bp}:${className} ` : '');
                }
            } else {
                const className = widths[w] ?? null;
                classes += (className ? `${className} ` : '');
                hasBase = true;
            }
        }
    } else {
        classes += widths[this.props.width.value] ?? widths.full;
        hasBase = true;
    }

    if (! hasBase) {
        classes = `${widths.full} ${classes}`;
    }

    return classes;
});
</script>

<template>
    <div :class="widthClasses">
        <slot />
    </div>
</template>
