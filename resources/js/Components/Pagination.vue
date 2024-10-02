<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
defineProps<{
    collection: object;
}>();
</script>
<template>
    <nav class="flex flex-wrap justify-center content-center items-center gap-4">
        <template v-for="link in collection.links" :key="link.label">
            <template v-if="link.url && !link.active">
                <Link
                    preserve-scroll
                    :href="link.url"
                    v-html="link.label"
                    class="px-4 py-2
                        border-b-4
                        border-gray-700
                        bg-gray-400
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest
                        hover:bg-gray-500
                        active:bg-gray-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500
                        focus:ring-offset-2
                        transition ease-in-out duration-150"
                />
            </template>
            <template v-else>
                <Link
                    onclick="event.preventDefault()"
                    preserve-scroll
                    v-html="link.label"
                    class="px-4 py-2
                        border-b-4
                        border-gray-700
                        bg-gray-300
                        rounded-md font-semibold text-xs text-gray-100 uppercase tracking-widest
                        hover:bg-gray-300
                        active:bg-gray-300
                        focus:outline-none
                        focus:ring-offset-0
                        focus:ring-0
                        cursor-default
                        focus:ring-gray-500
                        transition ease-in-out duration-150"
                />
            </template>
        </template>
    </nav>
</template>
