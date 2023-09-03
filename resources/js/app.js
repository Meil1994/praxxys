import { createApp } from 'vue';
import Products from './components/Products.vue';
import Create from './components/Create.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import Edit from './components/Edit.vue';


const app = createApp({
  components: {
    Products,
    Create,
    Edit,
    TailwindPagination,
  },
});



app.mount('#app');
