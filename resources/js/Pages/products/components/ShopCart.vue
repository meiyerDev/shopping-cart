<script setup>
import { computed, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Button from './Button.vue';

const emits = defineEmits(['less'])
const props = defineProps({
    cart: {
        type: Array,
        required: true
    }
})

const isLoading = ref(false)

const totalAmount = computed(() => {
    return props.cart.reduce((acc, product) => {
        return acc + (product.price * product.quantity)
    }, 0)
})

const generatePayment = () => {
    isLoading.value = true

    const products = props.cart.map((product) => {
        return {
            id: product.id,
            quantity: product.quantity
        }
    })

    fetch('/api/pay', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            products
        })
    }).then((response) => {
        if (!response.ok) {
            throw new Error('No se pudo crear la solicitud de pago, por favor espere y vuelva a intentarlo.');
        }
        return response.json();
    }).then((response) => {
        window.location.href = response.process_url
    }).catch((error) => {
        alert(error.message)
    }).finally(() => {
        isLoading.value = false
    })
}
</script>

<template>
    <div class="w-full h-screen">
        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                <div class="flex items-start justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        Carrito de compras
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="flow-root">
                        <div v-if="cart.length === 0">
                            No hay productos en el carrito..
                        </div>
                        <ul v-else role="list" class="-my-6 divide-y divide-gray-200">
                            <li v-for="product in cart" :key="`cart-product-${product.sku}`" class="flex py-6">
                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                    <img :src="product.image" :alt="product.name"
                                        class="h-full w-full object-cover object-center" />
                                </div>

                                <div class="ml-4 flex flex-1 flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3>{{ product.name }}</h3>
                                            <p class="ml-4">${{ product.price * product.quantity }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-1 items-end justify-between text-sm">
                                        <p class="text-gray-500">Cant {{ product.quantity }}</p>

                                        <div class="flex">
                                            <button @click="$emit('less', product)" type="button"
                                                class="font-medium text-orange-600 hover:text-orange-500 transition active:scale-95">Quitar</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                <div class="flex justify-between text-base font-medium text-gray-900">
                    <p>Total</p>
                    <p>${{ totalAmount }}</p>
                </div>
                <p class="mt-0.5 text-sm text-gray-500">Compra con PlacetoPay.
                </p>
                <div class="mt-6">
                    <Button @click="generatePayment" :disabled="cart.length === 0 || isLoading" type="button"
                        class="bg-orange-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-orange-500 active:bg-orange-600">
                        Ir a Pagar
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
