// resources/js/app.js
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

createInertiaApp({
  resolve: (name) => {
    // Проверяем доступные файлы
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    console.log('Available pages:', Object.keys(pages))
    
    // Явно проверяем существование файла
    const pagePath = `./Pages/${name}.vue`
    if (!pages[pagePath]) {
      console.error(`Page not found: ${pagePath}`)
      throw new Error(`Page ${name} not found`)
    }
    
    return pages[pagePath]
  },
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  }
})