<template>
    <div class="fixed top-[15%] right-0 w-[20%] z-40">
        <transition name="slide-right" mode="out-in">
            <div class="transition-transform">
                <AlertError v-if="statusAddCart == false">
                    <template v-slot:content>
                        <p class="text-black">{{ content }}</p>
                    </template>
                </AlertError>
                <AlertSuccess v-if="statusAddCart == true">
                    <template v-slot:content>
                        <div class="text-start">
                            <p class="text-black">
                                {{ content }}
                                <span><a href="" class="text-blue-500">Bấm vào đây để xem ngay nào!</a></span>
                            </p>
                        </div>
                    </template>
                </AlertSuccess>
            </div>
        </transition>
    </div>
    <div class="max-w-6xl bg-slate-100 p-16  m-auto" id="product">

        <div class="grid grid-cols-12 gap-4 ">
            <div class="col-span-5 p-4">
                <div class="max-w-[70%] m-auto mb-6">
                    <img class="aspect-square" :src="product_img" alt="" srcset="">
                </div>
                <div class="overflow-hidden relative" :class="{ 'justify-center': thumbnailsLength < 4 }">
                    <div :style="cardStyle" class="flex flex-nowrap gap-[1.35%]">
                        <img class="w-[24%] cursor-pointer  aspect-square " v-for="(item, index) in thumbnails" :key="index"
                            :src="item" alt="" :class="{ 'border-[2px] border-red-800 ': indeximg_hover === index }"
                            @mouseenter="handleChangeImg(index, item)">
                    </div>
                    <span
                        class="absolute cursor-pointer text-2xl bg-gray-500 w-8 text-center top-[calc(50%-16px)] left-1 text-[#333]"
                        :class="{ 'opacity-5': this.activeCardIndex <= 0 }" v-show="(thumbnailsLength > 4)"
                        @click="prevCard">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                    <span class="absolute cursor-pointer text-2xl bg-gray-500 w-8 text-center top-[calc(50%-16px)] right-1"
                        :class="{ 'opacity-5': this.activeCardIndex >= (thumbnailsLength - 4) }"
                        v-show="thumbnailsLength > 4" @click="nextCard">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>

                </div>
            </div>
            <div class="col-span-7 px-7 pt-4 flex flex-wrap ">
                <div class="w-full">
                    <h5 class="text-2xl mb-3 font-medium capitalize text-[#333]">{{ product.name }}</h5>
                    <span class=" text-[#333] text-xl mb-3 capitalize block">Thương hiệu : {{ category.name }}</span>
                    <div class="mb-3">
                        <span class="text-xl mr-14 text-[#333]">
                            Giá: <span class="text-inherit font-bold" style="color: red!important;">{{ getPrice
                            }}$</span>

                        </span>
                        <span class="text-xl text-[#333]">
                            Tổng số lượng: <span class="text-inherit  font-bold">{{ product.quantity }}</span>
                        </span>
                    </div>

                    <div class="group_color mb-3 flex items-center ">
                        <span class="mr-3 uppercase inline-block w-[90px] text-[#333]">Màu sắc: </span>
                        <div class="flex gap-2">
                            <button class="btn font-bold  py-2 px-5 rounded hover:border-red-600 hover:text-red-400"
                                v-for="(item, index) in colors" :key="item.id" @click="
                                    handleSelectImgByColor(item.id);
                                handlefindSizesByColorId(item.id);
                                setColorSelect(item.id);
                                "
                                :style="{ borderColor: color_id === item.id ? 'red' : '#cdcbcb', color: color_id === item.id ? 'red' : 'initial' }">{{
                                    item.name }} {{ item.id }}

                            </button>
                        </div>
                    </div>
                    <div class="group_color mb-3 flex items-start">
                        <span class="mr-3  uppercase inline-block w-[90px] text-[#333]">Kích cỡ: </span>
                        <div class="flex w-[calc(100%-90px)] gap-2 flex-wrap">
                            <button class="btn  font-bold py-2 px-5 rounded hover:border-red-600 hover:text-red-400 "
                                v-for="(item, index) in sizes" :key="item.id" @click="
                                    setSizeSelect(item.id, arraySize.includes(item.id))
                                    " :class="{ 'cursor-not-allowed opacity-30  ': !arraySize.includes(item.id) }"
                                :style="{ borderColor: size_id === item.id ? 'red' : '#cdcbcb', color: size_id === item.id ? 'red' : 'initial' }">{{
                                    item.name }}</button>
                        </div>
                    </div>
                    <div class="my-6">

                        <span class="mr-3 uppercase inline-block w-[90px] text-[#333]">
                            Số lượng:
                        </span>
                        <div class=" inline-block  w-[40%] ">
                            <span class=" border font-bold py-2 px-5 text-[#333]" @click="handleDecrease">-</span>
                            <span class=" border font-bold py-2 px-5 text-[#333]">{{ quantity_buy }}</span>
                            <span class=" border font-bold py-2 px-5 text-[#333]" @click="handleIncrease">+</span>

                        </div>
                    </div>
                    
                        <span @click="handleToggleTab" class="text-[#5849fe] underline font-medium cursor-pointer">Hướng
                            dẫn chọn size</span>
                    
                </div>
                <div class="w-full pt-4">
                    <button type="button" @click="handleAddToCart()"
                        class="text-xl mr-4 btn-addToCart px-3 py-3 text-orange-600 border-solid border-[0.5px] bg-orange-200 border-orange-400 hover:bg-orange-500 hover:text-white transition duration-300">
                        <i class="fas fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                    <button
                        class="text-xl btn-buy px-3 py-3 text-orange-100 border-solid border-[0.5px] bg-orange-500 border-orange-400 hover:bg-orange-700  transition duration-300">
                        Mua ngay
                    </button>
                </div>
            </div>

        </div>
        <div class=" mt-10">
            <span class="border-l border-r border-t py-2 px-3  bg-orange-700 text-white">Thông tin chi tiết sản
                phẩm</span>
            <div class="border text-[#333] mt-2 p-3 border-solid border-gray-100   bg-slate-200">
                <p class="text-[#333]">{{ description }}</p>
            </div>
        </div>
        <div class="mt-10">
            <h2 class="text-blue-600 text-2xl tracking-wider font-semibold mb-3 hover:text-red-500 text-center">. SAN PHAM
                TUONG TU .</h2>
            <ListProduct :products="productsInCategory"></ListProduct>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import ListProduct from './ListProduct.vue';
import AlertError from './Alert/AlertError.vue';
import AlertSuccess from './Alert/AlertSuccess.vue';

export default {
    props: ['product', 'productsInCategory', 'category', 'colors', 'sizes', 'thumbnails', 'product_img', 'quantity_buy', 'description', 'product_id', 'arraySize','priceByColorsSize'],
    emits:['findSizesByColorId','findImgColor', 'changeImage', 'increase', 'decrease','togleTabHelp','findPrice'],
    data() {
        return {
            param: Number.parseInt(atob(this.$route.query.id)),
            indeximg_hover: 0,
            activeCardIndex: 0,
            color_id: null,
            size_id: null,
            statusAddCart: null,
            content: "abc",
            

        };
    },
    computed: {
        ...mapGetters(['getisAuthenticated']),
        cardStyle() {
            return {
                transform: `translateX(-${this.activeCardIndex * 26}%)`,
                transition: 'transform 0.3s',
            };
        },
        thumbnailsLength(){
            if (this.thumbnails) {
                return this.thumbnails.length
            }
        },
        getPrice(){
            if(this.size_id&&this.color_id){
                console.log('if');
                this.$emit('findPrice',this.color_id,this.size_id)
                return this.priceByColorsSize
            }
            else{
                console.log('else');
                this.$emit('findPrice',this.color_id,this.size_id)
                return this.priceByColorsSize
            }
        }
    },
    watch: {
        'color_id': function (NewValue, Oldvalue) {
           
        }
    },
    methods: {
        ...mapActions(['addToCart','fetchCarts']),
        prevCard() {
            if (this.activeCardIndex > 0) {
                this.activeCardIndex--;
            }
        },
        nextCard() {
            if (this.activeCardIndex < this.thumbnails.length - 4) {
                this.activeCardIndex++;
            }
        },
        handleChangeImg(index, item) {
            this.indeximg_hover = index;
            this.$emit('changeImage', item);
        },
        handlefindSizesByColorId(color_id) {
          
            this.$emit('findSizesByColorId', color_id)
        },
        handleSelectImgByColor(a) {
            this.indeximg_hover = null;
            this.$emit('findImgColor', a);
        },
        handleIncrease() {
            this.$emit('increase');
        },
        handleDecrease() {
            this.$emit('decrease');
        },
        handleToggleTab() {
            this.$emit('togleTabHelp');
        },
        setColorSelect(id) {
            if (this.color_id == id) {
                this.color_id = null
                return 0
            }
            this.color_id = id
            
        },
        setSizeSelect(id, condition) {

            if (this.size_id == id || !condition) {
                this.size_id = null
                return 0
            }
            this.size_id = id;
           
        },
        //Xử lý haanhf động thêm vào giỏ hàng
        async handleAddToCart() {
            if (this.color_id && this.size_id) {

                if (this.getisAuthenticated) {
                    await this.addToCart({
                        product_id: this.product_id,
                        color_id: this.color_id,
                        size_id: this.size_id,
                        quantity_buy: this.quantity_buy
                    }).then((data)=>{
                        this.statusAddCart=data.status,
                        this.content = data.message
                        this.showNotification()
                        this.fetchCarts()
                    })
                    return 0
                }
                alert('chua dang nhap');
            }
            else {
                alert("Chọn màu vào size sản phẩm")
            }


        },
        showNotification() {
            setTimeout(() => {
                this.statusAddCart = null;
            }, 2000); // 5 seconds
        }
    },
    components: { ListProduct, AlertError, AlertSuccess }
}
</script>

<style scoped>
.btn {
    outline: none;
    border: 1px solid #e2e1e1;
}

.fas::before {
    color: rgb(234 88 12);
    transition: all 0.3s;
}

.btn-addToCart:hover .fas::before {
    color: #fff;

}

/* span {
    display: block;
    margin: 10px 0;
} */
</style>