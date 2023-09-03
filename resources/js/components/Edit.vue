<template>
    <div class="flex justify-center 588px:h-screen 588px:overflow-auto">
      <form class="pt-20 p-5" @submit.prevent="updateProduct">
        <div class="pb-20 w-100% 686px:w-500px">
          <div class="p-4 rounded-t-xl bg-slate-500 ring-2 ring-slate-500">
            <p class="text-center text-lg text-white">Edit Product</p>
          </div>
          <div class="p-10 shadow-sm shadow-slate-500 rounded-b-xl">
            <div v-if="currentStep === 1">
              <div>

                <label>Product Name</label>
                <input
                  v-model="product.name"
                  required
                  class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"
                />
                <p v-if="!product.name" class="text-red-500">Product Name is required.</p>
              </div>
  
              <div class="mt-4">
                <label>Product Category</label>
                <select
                  class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"
                >
                  <option>{{ product.category }}</option>
                  <option>Category 1</option>
                  <option>Category 2</option>
                  <option>Category 3</option>
                  <option>Category 4</option>
                </select>
                <p v-if="!product.category" class="text-red-500">Product Category is required.</p>
              </div>
  
              <div class="mt-4">
                <label class="mt-1">Product Description</label>
                <textarea
                  v-model="product.description"
                  class="ring-1 w-full mt-1 p-3 ring-amber-600 h-60 focus:outline-none focus:ring-2 focus:ring-amber-600"
                ></textarea>
                <p v-if="!product.description" class="text-red-500">Product Description is required.</p>
              </div>
  
              <div class="mt-8 top">
                <button @click="currentStep++" :disabled="!isStep1Valid" type="button" class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Next Page</button>
              </div>
            </div>
  
            <div v-if="currentStep === 2">
              <div v-if="currentStep === 2">
                <div v-if="product.images && product.images.length > 0" class="mt-4">
                  <label>Uploaded Images</label>
                  <div class="mt-4 w-full h-80" v-for="(image, index) in product.images" :key="index">
                    <img :src="basePath + image.path" :alt="'Product Image ' + index" class="object-cover object-top w-full h-full" />
                  </div>
                </div>

                <div v-else>
                  <p>No images uploaded yet.</p>
                </div>

                <div class="mt-4">
                  <label>Product ID</label>
                  <input
                    v-model="productId"
                    type="text"
                    class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"
                  />
                </div>

                <div class="mt-4">
                  <label>Select Images</label>
                  <input
                    type="file"
                    @change="handleFileInputChange"
                    class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"
                  />
                </div>
              </div>



                <div class="mt-8">
                    <button @click="currentStep++" class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Next Page</button>
                </div>
            </div>
  
            <div v-if="currentStep === 3">
              <div class="mt-4">
                <label>Date and Time</label>
                <input
                  type="datetime"
                  v-model="product.date_time"
                  class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"
                />
                <p v-if="!product.date_time" class="text-red-500">Date and Time are required.</p>
              </div>
  
              <div class="mt-8">
                <button :disabled="!isStep3Valid" class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </template>
  
 <script>
  import { ref, computed, onMounted } from 'vue';
  import axios from 'axios';

  export default {
    name: 'EditProduct',
    props: {
      initialProduct: Object,
    },
    setup(props) {
      const initialProduct = props.initialProduct;
      const product = ref(initialProduct);
      const currentStep = ref(1);
      const basePath = '/storage/';

      const productId = computed(() => product.value.id);

      if (!product.value.images) {
        product.value.images = [];
      }

      const handleFileInputChange = (event) => {
        const files = event.target.files;
        if (files.length > 0) {
          const selectedFile = files[0];
          product.value.images.push(selectedFile);
        }
      };

      const isStep1Valid = computed(() => {
        return (
          product.value.name.trim() !== '' &&
          product.value.category.trim() !== '' &&
          product.value.description.trim() !== ''
        );
      });

      const isStep3Valid = computed(() => {
        return product.value.date_time.trim() !== '';
      });

      const fetchProductImages = () => {
        axios
          .get(`/api/products/${initialProduct.id}/images`)
          .then((response) => {
            product.value.images = response.data.images;
          })
          .catch((error) => {
            console.error('Image retrieval error:', error);
          });
      };

      onMounted(() => {
        fetchProductImages();
      });

      const updateProduct = () => {
        const formData = new FormData();

        formData.append('name', product.value.name);
        formData.append('category', product.value.category);
        formData.append('description', product.value.description);
        formData.append('date_time', product.value.date_time);

        const imagesWithProductId = product.value.images.map((image) => ({
          image,
          product_id: productId.value,
        }));

        if (imagesWithProductId.length > 0) {
          imagesWithProductId.forEach((imageObject, index) => {
            formData.append(`images[${index}][product_id]`, imageObject.product_id);
            formData.append(`images[${index}][image]`, imageObject.image);
          });
        }

        console.log('Form Data:');
        for (const [key, value] of formData.entries()) {
          console.log(key, value);
        }

        const config = {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        };

        axios
          .post(`/api/products/update/${initialProduct.id}`, formData, config)
          .then((response) => {
            localStorage.setItem('successMessage', response.data.message);
            window.location.href = response.data.redirectTo; 
          })
          .catch((error) => {
            console.error(error);
          });
      };

      return {
        product,
        currentStep,
        basePath,
        handleFileInputChange,
        isStep1Valid,
        isStep3Valid,
        updateProduct,
        productId,
      };
    },
  };
</script>
  