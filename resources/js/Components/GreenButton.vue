<template>
    <button
        class="inline-flex items-center
        px-4 py-2
        border-b-4
        border-green-700
        bg-green-500
        rounded-md font-semibold text-xs text-white uppercase tracking-widest
        hover:bg-green-600
        active:bg-green-700
        focus:outline-none
        focus:ring-2
        focus:ring-green-500
        focus:ring-offset-2
        transition ease-in-out duration-150
        dark:focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
