<template>
    <BreadcrumbLinks>Sản phẩm yêu thích</BreadcrumbLinks>
    <div class="max-w-5xl mx-auto my-12 ">
        <h3 class="text-black text-center text-xl mb-10 ">Danh sach san pham yeu thich</h3>
        <ListProduct :products="products"></ListProduct>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import BreadcrumbLinks from '../components/Layouts/BreadcrumbLinks.vue';
import ListProduct from '../components/Layouts/ListProduct.vue';

    export default {
    components: { BreadcrumbLinks, ListProduct },
    computed:{
        ...mapGetters(['getFavoriteProduct']),
        products(){
            return this.getFavoriteProduct
        }
    }
}
</script>

<style scoped>

</style>