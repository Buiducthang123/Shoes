<template>
    <!--Thông báo đẩy-->
    <div class="fixed top-[15%] right-0 w-[20%] z-40">
        <transition name="slide-right" mode="out-in">
            <div class="transition-transform">
                <AlertError v-if="statusAddFavorite == false">
                    <template v-slot:content>
                        <p>{{ content }}</p>
                    </template>
                </AlertError>
                <AlertSuccess v-if="statusAddFavorite == true">
                    <template v-slot:content>
                        <div class="text-start">
                            <p>
                                {{ content }}
                                <span><a href="" class="text-blue-500">Bấm vào đây để xem ngay nào!</a></span>
                            </p>
                        </div>
                    </template>
                </AlertSuccess>
            </div>
        </transition>
    </div>
    <!---------------------------------------------->
    <div class="flex justify-center">
        <div class="max-w-5xl ">
            <slot></slot>
            <div class="grid grid-cols-4 gap-x-5 gap-y-8 ">
                <div class="relative m-auto" @mouseover="ProductHover = product.id" @mouseleave="ProductHover = null"
                    v-for="(product) in products" :key="product.id
                        ">

                    <img @click="handleProductClick(product)" width="240" height="240"
                        class="w-[220px] h-auto aspect-square" :src="product.image" alt="" :style="{
                            transform: ProductHover === product.id ? 'scale(1.02)' : 'scale(1)',
                            transition: 'transform 0.3s'
                        }">
                    <div @click="handleProductClick(product)">
                        <h4 class="text-start mt-2 text-xl uppercase">{{ product.name }}</h4>
                        <a class="block text-start my-2" href="">{{ product.category.name }}</a>
                        <span class="block text-start text-3xl font-medium text-red-500 md:text-xl">{{ product.base_price }}
                            ĐÔ
                            LA
                        </span>
                    </div>
                    <span class="absolute top-5 text-xl right-9 z-30 p-1 cursor-pointer ">
                        <i v-if="favoriteID.includes(product.id)!=true"
                        @click="addToFavorites(product.id)"
                            class="fa-regular fa-heart "></i>
                            <i class="fa-solid fa-heart favorite" @click="HandleDeleteFavoriteProduct(product.id)"  v-else></i>
                        </span>
                    <span
                        class="absolute top-14 text-xs bg-slate-800 bg-opacity-30 w-9 h-9 flex justify-center items-center rounded-[50%] -right-11 opacity-0 z-30"
                        :class="{
                            'right-6 opacity-100 transition-all': ProductHover === product.id
                        }"><i class="fa-solid fa-cart-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import AlertError from './Alert/AlertError.vue'
import AlertSuccess from './Alert/AlertSuccess.vue';
export default {
    props: {
        products: {
            type: [Array, Object],
            requied: true
        }
    },
    data() {
        return {
            ProductHover: null,
            statusAddFavorite: null,
            content: null
        };
    },
    computed: {
        ...mapGetters(['getisAuthenticated', 'getUser','getFavoriteProduct']),
        isAuthenticated() {
            return this.getisAuthenticated;
        },
        userID() {
            return this.getUser.id;
        },
        favoriteID(){
            let a = this.getFavoriteProduct.map((product)=>product.id)
            return a
        }
    },
    methods: {
        ...mapActions(['HandleAddFavorite','fetchFavoriteProduct','DeleteFavoriteProduct']),
        //Xử lý thông báo 
        showNotification(status) {
            this.statusAddFavorite = status
            setTimeout(() => {
                this.statusAddFavorite = null;
            }, 2000); // 5 seconds
        },



        handleProductClick(product) {
            // Mã hóa thông tin sản phẩm thành một mã không thể đọc được
            const encodedProductId = btoa(product.id);
            // Chuyển hướng tới trang chi tiết sản phẩm kèm thông tin đã mã hóa
            this.$router.push({ name: 'product', query: { id: encodedProductId } });
        },
        addToFavorites(product_id) {
            if (this.isAuthenticated && this.userID) {
                console.log("Thực hiện thêm sản phẩm vào danh sách yêu thích");
                this.HandleAddFavorite({
                    user_id: this.userID,
                    product_id: product_id
                }).then((data) => {
                    this.fetchFavoriteProduct()
                    this.showNotification(data.status)
                    this.content = data.message + '';
                    console.log(data.message + '');

                });
            }
            else {
                console.log("Cần đăng nhập để thực hiện thêm sản phẩm vào danh sách yêu thích");
            }
        },
        HandleDeleteFavoriteProduct(product_id){
            this.DeleteFavoriteProduct(product_id).then((data) => {
                    this.fetchFavoriteProduct()
                    this.showNotification(data.status)
                    this.content = data.message + '';
                    console.log(data.message + '');

                });
        }
    },
    components: { AlertError, AlertSuccess },
   
}
</script>

<style lang="scss" scoped>
*:not(h2, span, a) {
    color: #333;
}
.favorite::before{
    color: red;
    
}
</style>