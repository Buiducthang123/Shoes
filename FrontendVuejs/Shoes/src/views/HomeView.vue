<script>
import HomeAccessories from '../components/Home/HomeAccessories.vue';
import HomeBestSelling from '../components/Home/HomeBestSelling.vue';
import HomePicture from '../components/Home/HomePicture.vue';
import HomeSectionService from '../components/Home/HomeSectionService.vue';
import HomeTabProduct from '../components/Home/HomeTabProduct.vue';
import SectionProductNew from '../components/Home/SectionProductNew.vue';
import HomeFeedback from '../components/Home/HomeFeedback.vue';
export default {
    components:{
    HomeAccessories, HomeBestSelling, HomePicture, HomeSectionService, HomeTabProduct, HomeFeedback, SectionProductNew,
        
},
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
        },

    },
    mounted(){
        this.scrollToTop()
    }
}
</script>

<template>
    
    <HomePicture/>
    <HomeSectionService></HomeSectionService>
    <SectionProductNew></SectionProductNew>
    <HomeBestSelling></HomeBestSelling>
    <HomeTabProduct></HomeTabProduct>
    <HomeAccessories></HomeAccessories>
    <HomeFeedback></HomeFeedback>
    
</template>
