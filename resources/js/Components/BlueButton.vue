<template>
    <button
        class="inline-flex items-center
        px-4 py-2
        border-b-4
        border-blue-700
        bg-blue-400
        rounded-md font-semibold text-xs text-white uppercase tracking-widest
        hover:bg-blue-500
        active:bg-blue-700
        focus:outline-none
        focus:ring-2
        focus:ring-blue-500
        focus:ring-offset-2
        transition ease-in-out duration-150
        dark:focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
