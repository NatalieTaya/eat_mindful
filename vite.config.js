import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // путь к вашему CSS
                'resources/js/app.js',  // путь к вашему JS
            ],
            refresh: true,
        }),
    ],
});