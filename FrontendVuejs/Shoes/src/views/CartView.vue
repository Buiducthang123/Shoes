<template>
    <div class="my-40 max-w-5xl m-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-12 border p-3">
                <div class="grid grid-cols-12">
                    <div class="border col-span-6 text-center font-medium text-base">Thông tin sp</div>
                    <div class="border col-span-2 text-center font-medium text-base">Đơn giá </div>
                    <div class="border col-span-2 text-center font-medium text-base">Số lượng</div>
                    <div class="border col-span-2 text-center font-medium text-base">Thành tiền</div>

                </div>
            </div>
            <div class="col-span-12 border" v-for="(product) in products">
                <div class="grid grid-cols-12  p-3">
                    <div class=" col-span-6 h-24 flex p-3 ">
                        <img class="aspect-square h-full  " :src="product.thumbnail" alt=''>
                        <div class="ml-6 w-[60%] flex flex-wrap items-center">

                            <h2 class="font-medium w-full"><span class="text-black capitalize">{{ product.name }}</span> /
                                <span class="text-black capitalize">{{ product.category }}</span>
                            </h2>
                            <h6 class="w-full"><span class="text-black capitalize">{{ product.color
                            }}</span>/<span class="text-black capitalize">{{ product.size }}</span>
                            </h6>
                            <button class="text-red-500" @click="HandledeleteProduct(product.id)">Xóa</button>
                        </div>
                    </div>
                    <div class="border col-span-2 flex items-center justify-center">{{ product.price }} </div>
                    <div class="border col-span-2 flex items-center justify-center">
                        <div class="text-center flex items-center ">
                            <span
                                class="w-7 h-7 border-[0.5px] border-solid border-gray-400 leading-7 text-black cursor-pointer" @click="decrease(product)">-</span>
                            <span
                                class="inline-block w-7 h-7 border-[0.5px] border-solid border-gray-400 font-medium text-black leading-7">{{
                                    getQuantity(product) }}</span>
                            <span
                                class="w-7 h-7 border-[0.5px] border-solid border-gray-400 leading-7 text-black cursor-pointer"
                                @click="increase(product)">+</span>
                        </div>

                    </div>
                    <div class="border col-span-2 flex items-center justify-center">{{ product.priceProducts }}</div>

                </div>

            </div>
            <div class=" col-span-12 flex justify-end flex-wrap mt-5">
                <div class="w-1/4">
                    <div class=" flex justify-between mb-5">
                        <span class="text-black font-medium">Tổng tiền:</span>
                        <span class="text-red-600">{{ TotalAmount }}</span>
                    </div>
                    <button class="bg-blue-600 px-6 py-3 text-white w-full">Thanh Toán ngay</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { ref } from 'vue';
import { mapActions, mapGetters } from 'vuex'
export default {

    computed: {
        ...mapGetters(['getCarts', 'getAllProducts']),
        cartColorid() {
            return this.getCarts.map(element => ({
                product_colors_id: element.product_colors_id,
                size_id: element.size_id,
                quantity: element.pivot.quantity,
                id: element.id
            }));
        },
        products() {
            let a = this.getAllProducts;
            let b = this.cartColorid;

            let filteredProducts = [];

            b.forEach((e) => {
                const productsWithColor = a.filter(product => {
                    return product.product_colors.some(color => color.id === e.product_colors_id);
                });


                let filteredProductsSort = productsWithColor.filter(product => {
                    return product.product_colors.some(color => {
                        return color.sizes.some(size => size.id === e.size_id);
                    });
                });

                filteredProductsSort.forEach(product => {
                    const matchingColor = product.product_colors.find(color => color.id === e.product_colors_id);
                    const matchingSize = matchingColor.sizes.find(size => size.id === e.size_id);
                    if (matchingColor && matchingSize) {
                        product.selectedColor = matchingColor;
                        product.selectedSize = matchingSize;

                        // Lấy thumbnail từ mảng thumbnails của màu được chọn
                        const thumbnail = matchingColor.thumbnails[0];
                        if (thumbnail) {
                            product.thumbnail = thumbnail.image; // Lấy URL của thumbnail
                        }

                        // Lấy giá từ pivot của màu và kích cỡ được chọn
                        const price = matchingSize.pivot.cost;
                        if (price) {
                            product.price = price;
                        }

                        // Bổ sung thông tin cần thiết vào mảng filteredProducts
                        filteredProducts.push({
                            id: product.id,
                            name: product.name,
                            category: product.category.name,
                            thumbnail: product.thumbnail,
                            price: product.price,
                            quantity: e.quantity,
                            size: matchingSize.name, // Thêm thông tin kích cỡ
                            color: matchingColor.color.name, // Thêm thông tin màu sắc
                            priceProducts: product.price * e.quantity,
                            id: e.id
                        });
                    }
                });
            });

            console.log(filteredProducts);

            return filteredProducts;
        },
        TotalAmount() {
            let sum = 0;
            this.products.forEach((e) => {
                sum = sum + e.priceProducts
            })
            return sum
        }
    },
    methods: {
        ...mapActions(['deleteProductCart', 'fetchCarts', 'updateQuantity']),
        async HandledeleteProduct(id) {

            await this.deleteProductCart({ id: id });
            this.fetchCarts();
        },

        getQuantity(product) {
            return product.quantity;
        },
        increase(product) {
            product.quantity++;
            
            this.updateQuantity({ id: product.id, quantity_buy: product.quantity })
            this.fetchCarts();
            console.log(product.quantity);
        },
        decrease(product) {
            if (product.quantity > 1) {
                product.quantity--;
                this.updateQuantity({ id: product.id, quantity_buy: product.quantity })
                this.fetchCarts();
            }
        },

    }
}


</script>

<style scoped>
* :not(button, span) {
    color: #333;
}
</style>