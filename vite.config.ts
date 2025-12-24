import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    plugins: [],
    root: './',
    base: process.env.NODE_ENV === 'development' ? '/' : '/wp-content/themes/viewpoint/dist',
    build: {
        outDir: path.resolve(__dirname, './dist'),
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, './src/ts/main.ts'),
                style: path.resolve(__dirname, './src/css/main.css'),
            }
        }
    },
    server: {
        cors: true,
        port: 4321,
        hmr: {
            host: 'localhost',
        }
    },
});