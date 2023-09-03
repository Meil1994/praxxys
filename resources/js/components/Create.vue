<template>
    <div class="flex justify-center 588px:h-screen 588px:overflow-auto">
        <form class="pt-20 p-5" @submit.prevent="submitForm">
            <div class="pb-20 w-100% 686px:w-500px">
                <div class="p-4 rounded-t-xl bg-slate-500 ring-2 ring-slate-500">
                    <p class="text-center text-lg text-white">Create Product</p>
                </div>
                <div class="p-10 shadow-sm shadow-slate-500 rounded-b-xl">
                    <div v-if="currentStep === 1">
                        <div>
                            <label>Product Name</label>
                            <input 
                                v-model="products.name"
                                class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"/>
                                <span v-if="!products.name" class="text-red-600">Please enter a name</span>
                            </div>

                        <div class="mt-4">
                            <label>Product Category</label>
                            <select 
                            v-model="products.category"
                            class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600">
                                <option>Category 1</option>
                                <option>Category 2</option>
                                <option>Category 3</option>
                                <option>Category 4</option>
                            </select> 
                            <span v-if="!products.category" class="text-red-600">Please select a category</span>
                        </div>
                    
                        <div class="mt-4">
                            <label class="mt-1">Product Description</label>
                            <textarea
                                v-model="products.description"
                                class="ring-1 w-full mt-1 p-3 ring-amber-600 h-60 focus:outline-none focus:ring-2 focus:ring-amber-600"></textarea>
                                <span v-if="!products.description" class="text-red-600">Please enter a description</span>
                        </div>

                        <div class="mt-8 top">
                            <button 
                                @click="currentStep++"
                                type="button" 
                                :disabled="!isStep1Valid"
                                class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Next Page</button>
                        </div>
                    </div>

                    <div v-if="currentStep === 2">
                        <div class="mt-4">
                            <label>Select Images</label>
                            <input 
                                @change="handleFileInputChange"
                                type="file"
                                multiple
                                class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"/>
                                <span v-if="!products.images.length" class="text-red-600">Please select image/images</span>
                        </div>

                        <div class="mt-8">
                            <button  
                                type="button"
                                @click="currentStep--"
                                class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Back</button>
                        </div>

                        <div class="mt-8">
                            <button  
                                type="button"
                                :disabled="!isStep2Valid"
                                @click="currentStep++"
                                class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Next Page</button>
                        </div>
                    </div>

                    <div v-if="currentStep === 3">
                        <div class="mt-4">
                            <label>Date and Time</label>
                            <input 
                               v-model="products.date_time"
                                type="datetime-local"
                                class="mt-1 ring-1 w-full p-3 ring-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-600"/>
                                <span v-if="!products.date_time" class="text-red-600">Please select date and time</span>
                        </div>

                        <div class="mt-8">
                            <button  
                                type="button"
                                @click="currentStep--"
                                class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Back</button>
                        </div>

                        <div class="mt-8">
                            <button :disabled="!isStep3Valid" type="submit" class="ring-1 ring-amber-600 p-10 pt-2 pb-2 hover:bg-amber-600 hover:text-white">Update</button>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>
  </template>
  
  <script>
    import axios from 'axios';

    export default {
    data() {
        return {
            currentStep: 1,
            products: {
                name: '',
                category: '',
                description: '',
                date_time: '',
                images: [],
            },
        };
    },
    computed: {
        isStep1Valid() {
        return (
            this.products.name.trim() !== '' &&
            this.products.category.trim() !== '' &&
            this.products.description.trim() !== ''
        );
        },
        isStep2Valid() {
            return this.products.images.length > 0;
        },
        isStep3Valid() {
            return this.products.date_time.trim() !== '';
        },
        
    },
    methods: {
        
        handleFileInputChange(event) {
            this.products.images = event.target.files;
        },
        submitForm() {
            const formData = new FormData();
            formData.append('name', this.products.name);
            formData.append('category', this.products.category);
            formData.append('description', this.products.description);
            formData.append('date_time', this.products.date_time);

            for (let i = 0; i < this.products.images.length; i++) {
                formData.append(`images[]`, this.products.images[i]);
            }

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            };

            axios
                .post('/api/create/products', formData, config)
                .then((response) => {
                    console.log(response.data.message);
                    if (response.data.redirectTo) {
                        localStorage.setItem('successMessage', response.data.message);
                        window.location.href = response.data.redirectTo; 
                    } else {
                        console.error('Redirect URL not provided in response data.');
                    }
                })
                .catch((error) => {
                    console.error(error);
            });

        },
    },
};
</script>