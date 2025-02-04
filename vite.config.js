import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/assets/frontend/css/style.css'],
            //refresh: true,
        }),
    ],
    build: {
        minify: 'esbuild',
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                style: 'public/assets/frontend/css/style.css',
            },
        },
    },
});
