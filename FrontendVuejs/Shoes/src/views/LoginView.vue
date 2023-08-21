<template>
   
    <BreadcrumbLinks>{{ slot }}</BreadcrumbLinks>
    <TabForm :isLogin = isLogin></TabForm>
 
            
</template>

<script>
import FooterComponent from '../components/Layouts/FooterComponent.vue';
import HeaderComponent from '../components/Layouts/HeaderComponent.vue';

import BreadcrumbLinks from '../components/Layouts/BreadcrumbLinks.vue';
import LoginForm from '../components/Auth/LoginForm.vue';
import TabForm from '../components/TabForm.vue';



export default {
    
    components: { HeaderComponent, BreadcrumbLinks, LoginForm, TabForm, FooterComponent, HeaderComponent, FooterComponent },
    data() {
        return {
            slot:"Đăng nhập tài khoản",
            isLogin:true
        }
    },
  
}
</script>

<style lang="scss" scoped></style>