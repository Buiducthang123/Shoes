<template >
  <HeaderComponent></HeaderComponent>
  <div class="fixed top-[15%] right-0 w-[20%] z-50">
    <transition name="slide-right" mode="out-in">
      <div
        v-if="showNotification"
        class=" transition-transform "
      >
        
        <AlertSuccess v-if="showNotification"><template v-slot:content>Đã đăng nhập</template></AlertSuccess>
      </div>
    </transition>
  </div>
  <router-view></router-view>


  <FooterComponent></FooterComponent>
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex';
import HeaderComponent from './components/Layouts/HeaderComponent.vue';
import FooterComponent from './components/Layouts/FooterComponent.vue';
import AlertSuccess from './components/Layouts/Alert/AlertSuccess.vue';


export default {
  data() {
    return {
      showNotification: false
    }
  },
  components: {
    HeaderComponent, FooterComponent,
    AlertSuccess
},
  methods: {
    ...mapActions(['fetchProducts', 'fetchCategories', 'checkToken','fetchFavoriteProduct','fetchCarts','fetchSizes']),
    scrollToTop() {
      window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
    },
    showSuccessNotification() {

      this.showNotification = this.isAuthenticated;
      setTimeout(() => {
        this.showNotification = false;
      }, 2000); // 5 seconds
    }

  },
  computed: {
    ...mapGetters(['getisAuthenticated']),
    isAuthenticated() {
      console.log('chạy');
      return this.getisAuthenticated
    }

  },

  watch:{
    isAuthenticated(newValue,oldValue){
      if (newValue==true) {
        this.showSuccessNotification()
      }
    }
  },
  mounted() {
    (async () => {
      this.scrollToTop()
      await this.fetchProducts()
      await this.checkToken()
      await this.fetchCategories()
      await this.fetchFavoriteProduct()
      await this.fetchCarts()
      console.log(this.isAuthenticated);
      this.showSuccessNotification()
    })()
    console.log('app đc mount');

    
  },

}
</script>

<style lang="scss" scoped>
/* Tệp CSS của bạn hoặc phần style trong component */
@keyframes slideRight {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(0);
  }
}

.slide-right-enter-active
 {
  animation: slideRight 0.5s;
}

.slide-right-enter-from,
.slide-right-leave-to {
  transform: translateX(100%);
}

</style>