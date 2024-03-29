import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/connect.js',
            'resources/js/ajax/like.js',
            'resources/js/ajax/comment.js',
            'resources/js/ajax/block-message.js',
            'resources/js/ajax/dashboard.js',
            'resources/js/ajax/dashboard.js',
            'resources/js/ajax/delete-blog.js',
            'resources/js/ajax/delete-category.js',
            ],
            refresh: true,
        }),
    ],
});
