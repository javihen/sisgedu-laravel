import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'build',
            valetTls: false,
        }),
        tailwindcss(),
    ],
    base: './',
    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 5173,
    },
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        target: 'es2015',
        cssCodeSplit: true,
        sourcemap: false,
        minify: 'esbuild',
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios', 'sweetalert2', 'chart.js'],
                },
            },
        },
        chunkSizeWarningLimit: 600,
    },
    optimizeDeps: {
        include: ['axios', 'sweetalert2', 'chart.js'],
    },
});

