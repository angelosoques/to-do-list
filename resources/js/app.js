require('./bootstrap');

import {createApp} from 'vue'; 
import app from './components/app.vue'; 

const toDoListApp = createApp(app);

toDoListApp.mount('#todoListApp');
