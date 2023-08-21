<template>
    <section class="TabProduct bg-[#ececec] text-center mt-14 py-10 mb-10 ">
        <h2 class="text-blue-600 text-5xl tracking-wider uppercase font-semibold mb-3 hover:text-red-500">. SNEAKERS .</h2>
        <p class="text-sm mb-5">Cac san pham SNEAKERS tai cua hang</p>
        <div class="flex justify-center mb-8">
            <ul class="flex w-[70%] justify-between">
                <li class=" px-3 py-2 cursor-pointer " v-for="(category) in categories " :key="category.id"
                    @click="sellectCategory(category.id)"
                    :class="sellectIndex === category.id ? 'bg-blue-600 text-white' : 'text-black'">
                    {{
                        category.name
                    }}</li>
            </ul>
        </div>
       
       <ListProduct :products="products"></ListProduct> 
       
    </section>
</template>

<script>
import { mapGetters } from 'vuex';

import ListProduct from '../Layouts/ListProduct.vue';


export default {
    components:{ListProduct},
    data() {
        return {
            sellectIndex: 1,
           
            Products: null,
            ProductHover: null,
        }
    },
    methods: {
        sellectCategory(id) {
            this.sellectIndex = id;
            console.log('id'+ id);
        }


    },
    computed: {
        ...mapGetters(['getCategories','getAllProductByCategory']),
        categories(){
            return this.getCategories
        },
        products(){
            console.log(this.getAllProductByCategory(this.sellectIndex));
            return this.getAllProductByCategory(this.sellectIndex)
        }
        
    },
    components: {
    ListProduct
}
    ,
    mounted() {
    }
}
</script>

<style lang="scss" scoped>
*:not(h2, i, span, li) {
    color: #333;
}
</style>