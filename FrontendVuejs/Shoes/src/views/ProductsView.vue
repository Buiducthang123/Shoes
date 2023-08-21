<template>
    <BreadcrumbLinks>{{ this.Category }}</BreadcrumbLinks>
    <div class=" w-full flex justify-center bg-stone-300">
        <div class=" max-w-5xl w-full bg-slate-100 grid grid-cols-12 ">
            <div class="col-span-3 p-4">
                <SidebarFilter :category="[Category]" :colors="productColors" :sizes="productSizes"
                    @HandleSelectSort="HandleSelectSort" @HandleSelectSize="HandleSelectSize"
                    @HandleSelectColor="HandleSelectColor"></SidebarFilter>
            </div>
            <div class="col-span-9 h-full  p-6">
                <ListProduct :products="productFilters"></ListProduct>
            </div>
        </div>
    </div>
</template>

<script>
import SidebarFilter from '../components/Layouts/SidebarFilter.vue';
import HeaderComponent from '../components/Layouts/HeaderComponent.vue';
import BreadcrumbLinks from '../components/Layouts/BreadcrumbLinks.vue';
import ListProduct from '../components/Layouts/ListProduct.vue'
import { mapActions, mapGetters } from 'vuex';

export default {
    data() {
        return {
            Category: null,
            Category_id: Number.parseInt(this.$route.query.id),
            SelectSortIndex: 0,
            sizeSelectProduct: null,
            colorSelectProduct: null,


        }
    },
    methods: {
        ...mapActions(['fetchColors', 'fetchSizes']),
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        scrollToTop() {
            window.scrollTo({ top: 0, left: 0, behavior: 'auto' });

        },
        HandleSelectSort(index) {
            this.SelectSortIndex = index
            console.log(this.SelectSortIndex);
        },
        HandleSelectSize(id) {
            this.sizeSelectProduct = id
            console.log(this.sizeSelectProduct);
        },
        HandleSelectColor(id) {
            this.colorSelectProduct = id
            console.log(this.colorSelectProduct);
        },


    },
    components: { SidebarFilter, HeaderComponent, BreadcrumbLinks, ListProduct },

    computed: {

        ...mapGetters(['getAllProductByCategory', 'getColors', 'getSizes']),
        ProductInCategory() {
            return this.getAllProductByCategory(this.Category_id)
        },
        productColors() {
            return this.getColors
        },
        productSizes() {
            return this.getSizes
        },
        productsSort() {
            if (this.SelectSortIndex == 0) {
                console.log(this.getAllProductByCategory(this.Category_id));
                return this.getAllProductByCategory(this.Category_id)
            }
            if (this.SelectSortIndex == 1) {

                return this.getAllProductByCategory(this.Category_id).slice().sort((a, b) => a.name.localeCompare(b.name));
            }
            if (this.SelectSortIndex == 2) {

                return this.getAllProductByCategory(this.Category_id).slice().sort((a, b) => b.name.localeCompare(a.name));
            }
            if (this.SelectSortIndex == 3) {

                return this.getAllProductByCategory(this.Category_id).slice().sort((a, b) => a.base_price - b.base_price);
            }
            if (this.SelectSortIndex == 4) {

                return this.getAllProductByCategory(this.Category_id).slice().sort((a, b) => b.base_price - a.base_price);
            }

        },
        productFilters() {
            let a = this.productsSort;
            if (this.sizeSelectProduct && this.colorSelectProduct == null) {
                console.log('size chạy');
                let b = this.productsSort.map(products => products.product_colors);

                let filteredProductsSort = this.productsSort.filter((product, index) => {
                    let colors = b[index];
                    return colors.some(color => {
                        let sizes = color.sizes;
                        let filteredSizes = sizes.filter(size => size.id == this.sizeSelectProduct);
                        return filteredSizes.length > 0;
                    });
                });
                console.log(filteredProductsSort);
                return filteredProductsSort;

            }
            if (this.colorSelectProduct && this.sizeSelectProduct == null) {
                console.log('color chạy');
                let filteredProducts = this.productsSort.filter(product => {
                    return product.product_colors.some(product_color => {
                        return product_color.color_id == this.colorSelectProduct;
                    });
                });
                console.log(filteredProducts);
                return filteredProducts;
            }
            if (this.sizeSelectProduct && this.colorSelectProduct) {
                console.log('Cả hai điều kiện đều được chọn');
                console.log(this.sizeSelectProduct );
                console.log(this.colorSelectProduct);
                const productsWithColor = a.filter(product => {
                    return product.product_colors.some(color => color.color_id === this.colorSelectProduct);
                });
                console.log(productsWithColor);
                let b = productsWithColor.map(products => products.product_colors);
                let filteredProductsSort = productsWithColor.filter((product, index) => {
                    let colors = b[index];
                    return colors.some(color => {
                        let sizes = color.sizes;
                        let filteredSizes = sizes.filter(size => size.id == this.sizeSelectProduct);
                        return filteredSizes.length > 0;
                    });
                });
                console.log(filteredProductsSort);
                
                return filteredProductsSort;
            }
            return a

        }

    },
    watch: {
        '$route.params.name': function (newValue, oldValue) {

            let a = newValue.replace(/-/g, ' ').toLowerCase();
            this.Category = a.split(' ').map(this.capitalizeFirstLetter).join(' ');
            this.Category_id = Number.parseInt(this.$route.query.id)
            this.scrollToTop()
        },

    },
    mounted() {
        this.Category = this.$route.params.name
        this.Category_id = Number.parseInt(this.$route.query.id)
        this.fetchColors()
        this.scrollToTop()
    }

}
</script>

<style lang="scss" scoped>
* {
    color: #333;
}
</style>