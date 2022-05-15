<script setup>
import { computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import MenuItem from '@/Components/Navigation/MenuItem.vue';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false,
        required: false,
    },
});

const classes = computed(() => {
    return props.isOpen ? 'right-0' : '-right-full sm:-right-128';
});

const menuItemClasses = computed(() => {
    return 'w-full inline-flex items-center text-left text-white px-4 py-2 hover:bg-gray-800';
});

const path = computed(() => usePage().props.value.currentRoute);

const items = computed(() => usePage().props.value.navbar);

const user = computed(() => usePage().props.value.user);

/**
 * Logs the current user out.
 * @returns {void}
 */
const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div
        class="bg-nimbus-black overflow-hidden fixed top-0 bottom-0 w-full sm:w-128 main-menu transition-all duration-150 ease-in-out z-50"
        :class="classes"
    >
        <div class="flex items-center border-b border-white-100">
            <div class="w-full py-2 px-4 text-lg text-white">
                {{ user?.name }}
                <Link :href="route('profile.show')" class="block text-sm text-gray-200 hover:underline">
                    Manage Profile
                </Link>
            </div>

            <button class="material-icons md-30 px-2 text-white" @click="$emit('toggleMenu')">close</button>
        </div>

        <!-- Menu items -->
        <MenuItem
            v-for='(item, index) in items'
            :key="index"
            :active="path === item.route"
            :href="item.route"
            @click="$emit('toggleMenu')"
        >
            <span class="material-icons pr-2" v-if="item.icon">{{ item.icon }}</span>
            {{ item.name }}
        </MenuItem>

        <!-- Log out -->
        <form @submit.prevent="logout">
            <button :class="menuItemClasses" class="h-full menu-item">
                <span class="material-icons pr-2">logout</span>
                Logout
            </button>
        </form>
    </div>
</template>
