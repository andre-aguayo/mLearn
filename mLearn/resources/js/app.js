import './bootstrap';
import '../sass/app.scss'
import Router from '@/router'

import { createApp } from 'vue';

const app = createApp({});

app.use(Router);
app.mount('#app');