import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.ts',
            ],
            ssr: 'resources/scripts/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    ssr: {
        noExternal: ['@inertiajs/vue3/server'],
    },
    resolve: {
        alias: {
            'ziggy-js': path.resolve('./vendor/tightenco/ziggy'),
            '@/*': path.resolve('./resources/js/*'),
        },
        extensions: [
            '.js',
            '.ts',
            '.jsx',
            '.tsx',
            '.mdx',
            '.vue',
            '.svelte',
        ],
    },
});
