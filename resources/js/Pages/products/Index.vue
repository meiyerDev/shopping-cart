<script setup>
defineProps({
    products: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <div class="bg-white w-screen">
        <div class="grid grid-cols-4">
            <div class="mx-auto col-span-3 px-4 py-4 sm:px-6 sm:py-10 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Mi primera tienda</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 xl:gap-x-8">
                    <div v-for="product in products" :key="product.sku" class="relative">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none peer-hover:opacity-75 lg:h-80">
                            <img :src="product.image" :alt="product.name"
                                class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex justify-between peer">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ product.name }}
                                    </a>
                                </h3>
                            </div>
                            <p class="text-sm font-medium text-gray-900">${{ product.price }}</p>
                        </div>
                        <button type="button" class="bg-orange-500 text-white mt-2 rounded-md w-full text-center py-2">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            <!-- TODO: Remover background y agregar componente de carrito -->
            <div class="bg-slate-300 w-full px-4 py-4 sm:px-6 sm:py-10 lg:px-8">
                <h2 class="text-xl font-bold tracking-tight text-gray-900">Mi carrito</h2>
            </div>
        </div>
    </div>
</template>

<style></style>