<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FeatureCard from '@/Components/Cards/FeatureCard';</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <FeatureCard>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-2 text-2xl">
                        Welcome to Portal!
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <span class="text-3xl text-nimbus-secondary">
                                25
                            </span>
                            <span class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                games currently in action.
                            </span>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <span class="text-3xl text-nimbus-secondary">
                                30
                            </span>
                            <span class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                games have been won today.
                            </span>
                        </div>
                    </div>
                </div>
            </FeatureCard>
        </div>
    </AppLayout>
</template>
