<template>
    <button
        class="inline-flex items-center
        px-4 py-2
        bg-red-600
        border-b-4 border-red-700
        rounded-md
        font-semibold text-xs text-white uppercase tracking-widest
        hover:bg-red-500
        active:bg-red-700
        focus:outline-none
        focus:ring-2
        focus:ring-red-500
        focus:ring-offset-2
        transition ease-in-out duration-150
        dark:focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
