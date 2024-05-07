import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style-rtl.css',
                'resources/css/app.css',
                'resources/plugins/global/plugins.bundle.css',
                'resources/plugins/global/plugins.bundle.rtl.css',
                'resources/js/app.js',
                'resources/js/create-fast-category.js'
            ],
            refresh: true,
        }),
    ],
});
