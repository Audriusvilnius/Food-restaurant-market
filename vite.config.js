import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/back/app.scss',
                'resources/js/back/app.js',
                'resources/sass/front/app.scss',
                'resources/js/front/bootstrap.js',
                'resources/js/back/bootstrap.js',
                'resources/js/front/app.js',
            ],
            refresh: true,
        }),
    ],
});
