import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 
            'resources/sass/styles.scss','resources/sass/home.scss','resources/sass/loading.scss','resources/sass/deskripsi.scss'],
            refresh: true,
        }),
    ],
});
