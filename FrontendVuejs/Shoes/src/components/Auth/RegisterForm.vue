<template>
    <form name="register" class="p-7">
        <div class="mb-4">
            <label class="block font-medium mb-1" for="name">
                Họ và tên*
            </label>
            <input required class="w-full bg-gray-200 py-2 px-3" placeholder="Nhập Họ và tên" type="text" id="name"
                name="name" v-model="name">
            <div v-if="formErrors.name" class="text-red-500 mt-1">
                {{ formErrors.name }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="phone_number">
                Số Điện Thoại*
            </label>
            <input required class="w-full bg-gray-200 py-2 px-3" placeholder="Nhập số điện thoại" type="text"
                id="phone_number" name=" phone_number" v-model="phone_number">
            <div v-if="formErrors.phone_number" class="text-red-500 mt-1">
                {{ formErrors.phone_number }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="email">
                Email*
            </label>
            <input required class="w-full bg-gray-200 py-2 px-3" placeholder="Nhập địa chỉ email" type="text" id="email"
                name=" email" v-model="email">
            <div v-if="formErrors.email" class="text-red-500 mt-1">
                {{ formErrors.email }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="password">
                Mật khẩu*
            </label>
            <input required class="w-full bg-gray-200 py-2 px-3" placeholder="Nhập mật khẩu" type="password"
                id="password" name=" password" v-model="password">
            <div v-if="formErrors.password" class="text-red-500 mt-1">
                {{ formErrors.password }}
            </div>
        </div>

        <button type="button" class="w-full py-2 px-3 mt-3 bg-black text-white" @click="register">Đăng ký</button>
        <div class="text-center text-[10px] mt-2">
            <p class="text-gray-400">TD Shoes cam kết bảo mật và sẽ không bao giờ đăng</p>
            <p class="text-gray-400">hay chia sẻ thông tin mà chưa có được sự đồng ý của bạn.</p>
        </div>

    </form>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            name: '',
            phone_number: '',
            email: '',
            password: '',
            formErrors: {
                name: '',
                phone_number: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        ...mapActions(['HandleRegister']),
        register() {
            const phonePattern = /^\d{10}$/;
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            this.formErrors = {}; // Đặt lại đối tượng lỗi trước khi kiểm tra

            if (!phonePattern.test(this.phone_number)) {
                this.formErrors.phone_number = 'Số điện thoại không hợp lệ.';
                return;
            }

            if (!emailPattern.test(this.email)) {
                this.formErrors.email = 'Địa chỉ email không hợp lệ.';
                return;
            }

            else {
                console.log('đã chạy');
                this.HandleRegister({
                    email: this.email,
                    password: this.password,
                    phone_number: this.phone_number,
                    name: this.name
                });
            }

        }
    }
}
</script>

<style lang="scss" scoped>
*:not(a, button, p) {
    color: #333;
}

input::placeholder {
    font-size: 12px;
    line-height: normal;
}
</style>
