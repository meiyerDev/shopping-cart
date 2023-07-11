<script setup>
import { ref, onMounted } from 'vue'
import ShopCart from './components/ShopCart.vue';
import ProductList from './components/ProductList.vue';

defineProps({
    products: {
        type: Array,
        required: true
    }
})

const cart = ref([])

const addToCart = (product) => {
    const productInCart = cart.value.find((item) => item.sku === product.sku)
    if (productInCart) {
        productInCart.quantity++
    } else {
        cart.value.push({
            ...product,
            quantity: 1
        })
    }
    localStorage.setItem('cart', JSON.stringify(cart.value))
}

const removeFromCart = (product) => {
    const productInCart = cart.value.find((item) => item.sku === product.sku)
    if (productInCart) {
        productInCart.quantity--
        if (productInCart.quantity === 0) {
            cart.value = cart.value.filter((item) => item.sku !== product.sku)
        }
    }
    localStorage.setItem('cart', JSON.stringify(cart.value))
}

onMounted(() => {
    const cartLocalStorage = localStorage.getItem('cart')
    if (cartLocalStorage) {
        cart.value = JSON.parse(cartLocalStorage)
    }
})
</script>

<template>
    <div class="bg-white">
        <div class="grid grid-cols-4">
            <div class="col-span-3">
                <ProductList :products="products" @add="addToCart" />
            </div>
            <ShopCart :cart="cart" @more="addToCart" @less="removeFromCart" />
        </div>
    </div>
</template>

<style></style>