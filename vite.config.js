import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import preact from "@preact/preset-vite";


export default defineConfig({
    plugins: [
        preact({
            prefreshEnabled: true,
        }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});