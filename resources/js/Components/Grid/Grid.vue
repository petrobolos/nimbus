<script setup>
import { computed } from 'vue';

const props = defineProps({
   gapWidth: {
       default: 'md',
       required: false,
       type: String,
   },

    responsive: {
       default: true,
       required: false,
       type: Boolean,
    },
});

const gaps = {
    'none': 'gap-0',
    'xs'  : 'gap-2',
    'sm'  : 'gap-4',
    'md'  : 'gap-8',
    'lg'  : 'gap-12',
    'xl'  : 'gap-16',
};

const gridClasses = computed(() => {
    const gridClass = `grid ${gapClass}`;

    return props.responsive.value
        ? `${gridClass} grid-cols-none md:grid-cols-12`
        : `${gridClass} grid-cols-12`;
});

const gapClass = computed(() => {
    const bps = 'sm md lg xl'.split(' ');
    let classes = '';
    let bp, size;
    let hasBase = false;

    if (props.gapWidth.value.includes(':')) {
        const widths = props.gapWidth.value.split(' ');

        for (let i = 0; i < widths.length; i++) {
            if (widths[i].includes(':')) {
                [bp, size] = widths[i].split(':');

                if (size && bps.includes(bp)) {
                    classes += (gaps[size] ? `${bp}:${gaps[size]} ` : '')
                }
            } else {
                const className = gaps[widths[i]] ?? null;
                classes += (className ? `${className} ` : '');
                hasBase = true;
            }
        }
    } else {
        classes += gaps[props.gapWidth.value] ?? 'col-span-12 ';
        hasBase = true;
    }

    if (! hasBase) {
        classes = 'gap-0 ' + classes;
    }

    return classes;
});


</script>
