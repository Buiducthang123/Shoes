<template>
    <section  class="w-full relative -z-10" :style="'background-image: url(' + Bg_breadcrumb_SRC + ');'" >
        <div class="w-full min-h-[304px] flex justify-center items-center" 
        style="background: rgba(24,24,24,0.4);"
        >
        <div class="text-center">
           <h1 class="text-3xl font-bold font-serif mb-3 uppercase "> <slot></slot></h1>
           <span>

               <span class="px-1">Trang chủ</span>
               <span class="">/</span>
               <span class="px-1 text-red-500 uppercase"><slot></slot></span>
           </span>
            
        </div>

        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return{
                Bg_breadcrumb_SRC : "https://bizweb.dktcdn.net/100/423/630/files/bg-breadcrumb.jpg?v=1640052952057",
            }
        }
    }
</script>

<style lang="scss" scoped>
.cover_img{
    
}
</style>