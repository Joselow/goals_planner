import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue';
import App from './App.vue';
import Loader from './commons/Loader.vue';

const app = createApp(App)
app.component('Loader', Loader);

console.log(app);

app.mount('#app')