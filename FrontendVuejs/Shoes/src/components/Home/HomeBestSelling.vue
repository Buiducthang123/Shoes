<template>
    <section class="BestSelling text-center mt-14">
        <h2 class="text-blue-600 text-5xl tracking-wider font-semibold mb-3 hover:text-red-500">. SAN PHAM BAN CHAY.</h2>

        <p class="text-sm mb-5">Cac san ban chay nhat</p>
        
       

        <ListProduct :products="bestSellingProduct">
            <img src="https://bizweb.dktcdn.net/100/437/253/collections/img-best-sellers.jpg?v=1640074839860" alt="" class="mb-16">
        </ListProduct>
    </section>
</template>

<script>
import fetchAPI from '../../ultils/api';
import ListProduct from '../Layouts/ListProduct.vue';

export default {
    data() {
        return {
            bestSellingProduct: [],
            
        };
    },
    computed: {},
    mounted() {
        fetchAPI("http://127.0.0.1:8000/api/bestSelling").then((data) => {
            this.bestSellingProduct= data.bestSelling
        });
    },
    components: { ListProduct }
}
</script>

<style lang="scss" scoped>
*:not(h2, span, a) {
    color: #333;
}
</style>