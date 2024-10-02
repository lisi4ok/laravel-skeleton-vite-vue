<script setup lang="ts">
withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
    }>(),
    {
        type: 'button',
    }
);
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center
        px-4 py-2
        bg-white
        dark:bg-gray-800
        rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm
        hover:bg-gray-50
        border border-gray-300
        focus:outline-none
        focus:ring-2
        focus:ring-indigo-500
        focus:ring-offset-2
        disabled:opacity-25
        transition ease-in-out duration-150
        dark:border-gray-500
        dark:text-gray-300
        dark:hover:bg-gray-700
        dark:focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
