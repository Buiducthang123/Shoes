<template>
    <section class="w-full py-10 px-5 text-gray-800 flex justify-center items-center">
        <div class="w-[55%] rounded-xl overflow-hidden shadow-lg">
            <div class="h-12 flex items-center">
                <div
                    class="flex-grow-1 w-[50%] h-full flex items-center justify-center  text-center border border-gray-200  " :class="{'bg-gray-800 text-white':isLogin }"   >
                    <span class=" font-medium w-[60%] " :class="{' text-black':!isLogin }" >
                        <router-link to="login">Đăng nhập</router-link>
                    </span>
                </div>
                <div
                    class="flex-grow-1 w-[50%] h-full flex items-center justify-center  text-center border border-gray-200" :class="{'bg-gray-800 text-white':!isLogin }">
                    <span class=" font-medium  w-[60%] " :class="{' text-black':isLogin }" ><router-link :to="{name:'register'}">Đăng ký</router-link></span>
                </div>
            </div>
            <LoginForm v-if="isLogin"></LoginForm>
            <RegisterForm v-else></RegisterForm>

        </div>
    </section>
</template>

<script>
import LoginForm from './Auth/LoginForm.vue';
import RegisterForm from './Auth/RegisterForm.vue';

export default {

    components: { LoginForm, RegisterForm },
    props:['isLogin'],
    data(){
        return{
            
        }
    }
}
</script>

<style lang="scss" scoped>

</style>