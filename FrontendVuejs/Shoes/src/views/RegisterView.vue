<template>
    <HeaderComponent></HeaderComponent>
    <BreadcrumbLinks></BreadcrumbLinks>
    <TabForm :isLogin = isLogin></TabForm>
    
            
</template>

<script>

import BreadcrumbLinks from '../components/Layouts/BreadcrumbLinks.vue';
import LoginForm from '../components/Auth/LoginForm.vue';
import TabForm from '../components/TabForm.vue';

import HeaderComponent from '../components/Layouts/HeaderComponent.vue';


export default {
    components: { HeaderComponent, BreadcrumbLinks, LoginForm, TabForm },
    data() {
        return {
            slot:"Đăng ký tài khoản",
            isLogin:false
        }
    },
  
}
</script>

<style lang="scss" scoped></style>