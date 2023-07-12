<script setup>
import { onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    order: {
        type: Object,
        required: true
    }
})

const messages = {
    REJECTED: 'Has rechazado la compra',
    PAYED: 'Has completado la compra',
    CANCELED: 'Has cancelado la compra'
}

onMounted(() => {
    if (props.order.status === 'PAYED') {
        localStorage.removeItem('cart');
        setTimeout(() => {
            window.location.href = '/'
        }, 3000)
    }
})
</script>

<template>
    <div className="h-screen flex justify-center">
        <div
            className="w-1/2 bg-white space-y-3 rounded py-5 flex justify-center items-center flex-col text-center">
            <h3 className="text-2xl mb-2">{{ messages[order.status] }}<br /><span className="text-base">de la Orden no.
                    {{order.code}}</span></h3>
            <p className="text-gray-500">
                <Link href="/">ir al Inicio <span v-if="order.status !== 'PAYED'">para reintentar</span></Link>
            </p>
        </div>
    </div>
</template>

<style></style>