import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [vue()],
    server: {
        host: "0.0.0.0",
        watch: {
            usePolling: true
        },
        strictPort: true,
        hmr: {
            port: 5173
        },
        port: 5173
    }
})
