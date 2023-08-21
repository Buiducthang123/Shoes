<template>
    <form name="login" action="" class="p-7">
        <label class="block font-medium mb-3" for="email">
            Email*
        </label>
        <input required class="w-full mb-1 bg-gray-200 py-2 px-3" placeholder="Nhập địa chỉ email" type="text" id="email"
            name="email" v-model="email">
        <span v-if="!isEmailValid" class="text-red-600 text-xs mb-4 block">Please enter a valid email address*</span>

        <label class="block font-medium mb-3" for="password">
            Mật khẩu*
        </label>
        <input required class="w-full mb-1 bg-gray-200 py-2 px-3" placeholder="Nhập mật khẩu" type="password"
            id="password" name="password" v-model="password">
        <span v-if="!isPasswordValid" class="text-red-600 text-xs mb-4 block">Mật khẩu phải dài hơn 8 kí tự và không
            chứa dấu cách*</span>
        <span v-if="!isLogin" class="text-red-600 text-xs mb-4 block">Vui lòng kiểm tra lại email hoặc password*</span>

        <a href="" class="text-blue-600 text-xs">Quên mật khẩu?</a>

        <button @click="login" type="button" class="w-full py-2 px-3 mt-3 bg-black text-white">Đăng nhập</button>

        <div class="text-center text-[10px] mt-2">
            <p class="text-gray-400">TD Shoes cam kết bảo mật và sẽ không bao giờ đăng</p>
            <p class="text-gray-400">hay chia sẻ thông tin mà chưa có được sự đồng ý của bạn.</p>
        </div>
    </form>
</template>
  
<script>
import { mapActions, mapState } from "vuex"
export default {

    data() {
        return {
            email: "",
            password: "",
            isEmailValid: true,
            isPasswordValid: true,
            isLogin: true,
        };
    },
    methods: {
        ...mapActions(['HandleLogin']),
        login() {
            this.validateForm();

            if (this.isEmailValid && this.isPasswordValid) {
                this.HandleLogin({email:this.email,password:this.password})
            } else {
                console.log("hiiiii");
            }
        },
        validateForm() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            this.isEmailValid = emailRegex.test(this.email);
            this.isPasswordValid = this.password.length >= 6 && !/\s/.test(this.password);
         
        },
        
    },


};
</script>
  
<style lang="scss" scoped>
*:not(a, button, p, span) {
    color: #333;
}

input::placeholder {
    font-size: 12px;
    line-height: normal;
}
</style>
  