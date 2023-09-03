<template>
  <div class=" 588px:h-screen 588px:overflow-auto overflow-x-scroll">
      <div class="p-15px border-b border-slate-500 flex justify-between">
        <input 
          v-model="searchKeyword" 
          @input="searchProducts" 
          placeholder="Search by Name or Description" 
          class="p-2 border border-amber-600 w-80" />
        <select v-model="selectedCategory" @change="searchProducts" class="ml-5 p-2 border border-amber-600 w-80">
          <option value="">All Categories</option>
          <option v-for="category in categories" :key="category">{{ category }}</option>
        </select>

      </div>

      <div class="p-15px">
        <table v-if="products.data.length > 0">
          <tr class="bg-slate-300">
            <th class="p-2">ID</th>
            <th class="p-2 flex justify-start">Name</th>
            <th class="p-2">Category</th>
            <th class="">Description</th>
            <th></th>
          </tr>
          <tr 
            class="border-b border-slate-400"
            v-for="product in products.data" :key="product.id">
            <td class="p-4">{{ product.id }}</td>
            <td class="p-4">{{ product.name }}</td>
            <td class="p-4">{{ product.category }}</td>
            <td class="p-4">{{ product.description }}</td>
            <td class="p-4">
              <button @click="deleteProduct(product.id)"><i class="fa-solid fa-trash text-red-600 hover:text-red-700"></i></button>
              <a :href="getEditUrl(product.id)"><i class="fa-solid fa-file-pen text-sky-600 hover:text-sky-700 mt-2"></i></a>
            </td>
          </tr>
        </table>

        <div v-else>
          <p  class="text-red-600">No Product Available.</p>
          <button class="p-1 mt-2 bg-sky-600 text-white hover:bg-sky-500">Add New Product</button>
        </div>

        <TailwindPagination
          v-if="products.data"
          :data="products"
          @pagination-change-page="getProducts"
          class="mt-20"
        >

          <template v-slot:prev-nav>
            <button class="pagination-prev-button">Previous</button>
          </template>

          <template v-slot:next-nav>
            <button class="pagination-next-button">Next</button>
          </template>

        </TailwindPagination>
      </div>
  </div>
</template>

<script setup>
import { ref, computed} from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';

const searchKeyword = ref('');
const selectedCategory = ref('');
const products = ref({ data: [] });


const getProducts = async (page = 1) => {
  const response = await fetch(`/api/products?page=${page}`);
  products.value = await response.json();
};

const categories = computed(() => {
  const uniqueCategories = new Set(products.value.data.map(product => product.category));
  return [''].concat(Array.from(uniqueCategories));
});

const searchProducts = async () => {
  const params = new URLSearchParams();
  if (searchKeyword.value) {
    params.append('search', searchKeyword.value);
  }
  if (selectedCategory.value) {
    params.append('category', selectedCategory.value);
  }

  const response = await fetch(`/api/products/search?page=1&${params.toString()}`);
  products.value = await response.json();
};

const showToast = (message) => {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toastContainer.removeChild(toast);
    }, 3000);
}

const deleteProduct = async(productId) =>{
  try {
    const response = await fetch(`/api/products/${productId}`,{
      method: 'DELETE',
    });
    if (response.ok) {
      getProducts();
      showToast('Product deleted successfully');
    } else {
      showToast('Error deleting product');
    }
  } catch (error) {
    showToast('An error occurred while deleting the product'); 
  }


};

const getEditUrl = (productId) => {
  return `/api/products/edit/${productId}`;
};



getProducts();
</script>

<style>
.pagination-prev-button {
  border: 2px solid black;
  background-color: blue;
}

.pagination-next-button {
  border: 2px solid black;
  background-color: blue;
}


button[aria-current="page"] {
  background-color: blue;
  color: bisque;
  width: 40px;
  height: 40px;
}
</style>
