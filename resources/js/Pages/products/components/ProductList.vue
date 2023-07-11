<script setup>
defineEmits(['add'])

defineProps({
    products: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <div class="mx-auto px-4 py-4 sm:px-6 sm:py-10 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Mi primera tienda</h2>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 md:grid-cols-3 xl:gap-x-8">
            <div v-for="product in products" :key="product.sku" class="relative">
                <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none peer-hover:opacity-75 lg:h-80">
                    <img :src="product.image" :alt="product.name"
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                </div>
                <div class="mt-4 flex justify-between peer">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            {{ product.name }}
                        </h3>
                    </div>
                    <p class="text-sm font-medium text-gray-900">${{ product.price }}</p>
                </div>
                <button type="button" @click="$emit('add', product)"
                    class="bg-orange-500 text-white mt-2 rounded-md w-full text-center py-2">
                    Agregar al carrito
                </button>
            </div>
        </div>
    </div>
</template>