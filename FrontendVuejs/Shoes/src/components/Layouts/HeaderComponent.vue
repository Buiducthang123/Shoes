<template>
    <header class="  bg-slate-900 py-6 px-6 flex justify-center fixed w-full z-40 top-0 ">
        <div class="flex container  max-w-5xl">
            <div class="flex-grow w-1/6 px-4">
                <img src="../../assets/images/logo.webp" alt="Hình ảnh chứa logo">
            </div>
            <div class="flex-grow w-2/3 px-4 text-sm font-medium">
                <div class=" w-full flex justify-center ">
                    <ul class="flex justify-around">
                        <li class="px-6"><router-link to="/"><a href="#">Trang chủ</a></router-link></li>
                        <li class="px-6"><router-link to="/gioi-thieu">Giới thiệu</router-link></li>
                        <li class="relative nav-item" @mouseenter="isDropdownOpen = true"
                            @mouseleave="isDropdownOpen = false"><a href="#">
                                Sản phẩm
                                <span class="pl-2" :style="{ 'transform: rotate(180deg);': isDropdownOpen }"><i
                                        class="fa-solid fa-caret-down"></i></span>
                                <ul class="absolute bg-slate-900 text-start  w-[200%] top-[180%] opacity-0" :style="{
                                    'opacity': isDropdownOpen ? '1' : '0',
                                    'height': isDropdownOpen ? 'auto' : '0',
                                    'z-index': isDropdownOpen ? '1000' : '-1',
                                    'pointer-events': isDropdownOpen ? 'unset' : 'none'
                                }">
                                    <li class=" border-b-slate-50 leading-10 pl-5 border-b-[1px] border-[#333]"
                                        @click="isDropdownOpen = false" v-for="( item, index ) in   CategoriesName"
                                        :key="item.id">
                                        <router-link
                                            :to="{ path: `/${convertToSlug(item.name)}`, query: { id: item.id } }">{{
                                                item.name }}</router-link>
                                        <a class="" href="#"></a>
                                    </li>
                                </ul>

                            </a></li>
                        <li class="px-6"><a href="#">Tin tức</a></li>
                        <li class="px-6"><a href="#">Liên hệ</a></li>
                    </ul>

                </div>
            </div>
            <div class="flex-grow w-1/6 px-2">
                <div class="flex justify-between">
                    <span>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <span class="relative user_icon">
                        <i class="fa-regular fa-user"></i>
                        <span
                            class="w-0 h-0 absolute top-full right-0 z-10 border-b-[15px] border-l-[10px] border-r-[10px] border-transparent border-b-slate-100 hidden "></span>

                        <span class="absolute top-[150%] bg-slate-100  w-28 -right-2.5 hidden">

                            <ul class="">
                                <li class="text-black text-xs p-2 border-b-2 ">
                                    <router-link :to="{ name: 'login' }" v-if="!isAuthenticated">Đăng
                                        nhập</router-link>
                                    <span class="text-black text-xs" v-else>{{ userName }}</span>
                                </li>
                                <li class="text-black text-xs p-2 border-b-2 border-b-slate-600 "><router-link
                                        :to="{ name: 'register' }" v-if="!isAuthenticated">Đăng ký</router-link>
                                    <button class="text-black text-xs" @click="this.logout()" v-else>Logout</button>
                                </li>
                            </ul>
                        </span>
                    </span>
                    <span class="relative ">
                        <router-link to="/san-pham-yeu-thich"><i class="fa-sharp fa-regular fa-heart"></i>
                            <span
                                class="absolute left-[70%] bg-red-600 w-[14px] h-[14px] rounded-[50%]  bottom-[50%] leading-[14px] text-center text-xs">{{
                                    numberOfFavorite }}</span></router-link>
                    </span>
                    <span class="relative ">
                        <router-link to="/gio-hang"><i class="fa-solid fa-cart-shopping"></i>
                            <span
                                class="absolute left-[70%] bg-red-600 w-[14px] h-[14px] rounded-[50%]  bottom-[50%] leading-[14px] text-center text-xs">{{
                                    quantityProductsCart }}</span></router-link>
                    </span>
                </div>

            </div>
        </div>
    </header>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {


    data() {
        return {

            isDropdownOpen: false,
        }
    },
    methods: {
        ...mapActions(['logout']),
        convertToSlug(text) {
            return text
                .toLowerCase()
                .replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");
        },

    },
    computed: {
        ...mapGetters(['getCategories', 'getisAuthenticated', 'getUserName', 'getFavoriteProduct', 'getCarts']),
        CategoriesName() {
            console.log(this.getCategories);
            return this.getCategories
        },

        isAuthenticated() {
            return this.getisAuthenticated
        },
        userName() {
            console.log(this.getUserName);
            return this.getUserName
        },
        numberOfFavorite() {
            return this.getFavoriteProduct.length
        },
        quantityProductsCart() {
            return this.getCarts.length
        }
    },

}
</script>

<style lang="scss" scoped>
.nav-item {
    &:hover {
        ul {
            opacity: 1;
            height: auto;
            z-index: 1000;
            pointer-events: unset;
        }

        i {
            transform: rotate(180deg);
        }
    }

}

.user_icon {
    &:hover {
        span {
            display: block;
        }
    }

    &::after {
        content: '';
        display: block;
        position: absolute;
        right: -20%;
        top: 70%;
        width: 400%;
        height: 20px;
        background-color: transparent;
    }
}

.nav-item {
    i {
        transition: all 0.2s linear;
    }

    ul {
        transition: opacity 0.1s ease-in, height 0.6s ease-in;
        transform: scaleY(20deg);
        pointer-events: none;
    }
}

// Định nghĩa phần tử giả
%bottom-item {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 16px;
    background-color: transparent;
}

// Sử dụng phần tử giả trong .nav-item::after
.nav-item {
    &::after {
        @extend %bottom-item;
    }
}
</style>