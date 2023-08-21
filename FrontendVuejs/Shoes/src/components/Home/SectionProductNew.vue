<template>
    <section class="SectionProductNew text-center mt-14">
        <h2 class="text-blue-600 text-5xl tracking-wider font-semibold mb-3 hover:text-red-500">. SAN PHAM MOI .</h2>
        <p class="text-sm mb-5">Cac san pham moi co tai cua hang</p>

        <ListProduct :products="latestProducts"></ListProduct>
        <div class="text-center pt-12"><a href="" class="bg-blue-800 rounded-sm px-5 py-2 text-xl">Xem tất cả</a></div>
    </section>
</template>

<script>

import ListProduct from '../Layouts/ListProduct.vue';
import { mapGetters, } from 'vuex';

export default {
    data() {
        return {
            
        };
    },
    methods: {
    
    },
    computed: {
        ...mapGetters(['sortProductsByDate']),
        latestProducts(){
            console.log(this.sortProductsByDate);
            return this.sortProductsByDate
        }
    },
    watch: {
            
    },
   
    components: { ListProduct }
}
</script>

<style lang="scss" scoped></style>