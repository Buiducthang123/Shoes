<template>
    <section class="SectionFeedback text-center my-14 relative " style="">
        <div class="w-full h-full p-16 " style="background: rgba(0, 0, 0, 0.7);">
            <h2 class=" text-5xl tracking-[0.3em] font-semibold mb-3 hover:text-red-500">. FEEDBACK .</h2>
            <p class="text-sm mb-10">Cac san phụ kiện co tai cua hang</p>
            <div class=" flex justify-center">
                <div class="max-w-5xl flex flex-nowrap gap-[1.01%]  overflow-hidden"
                
                >
                    <img width="270" class="h-auto w-[19%]" v-for="(item, index) in img_feddback" :key="index" :src="item" 
                        alt="Hình ảnh feedback"
                        :style="spanIndex === 2 ? {'transform': 'translate(-100%, 0px)', 'transition': 'transform 0.3s'} : {'transform': 'translate(0%, 0px)', 'transition': 'transform 0.3s'}"
                        
                        >

                </div>
            </div>
            <div class="mt-10">
                <span v-for="(index) in 2" :key="index" class="inline-block cursor-pointer h-2  mr-2 "
                :style="spanIndex===index?'background-color:#fff;width:40px':'background-color:#999;width:20px'"
                @click="HandleSeclect(index)"
                   ></span>
                
            </div>
        </div>


    </section>
</template>

<script>
export default {
    data() {
        return {
            spanIndex:1,
            img_feddback: ["https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_1.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_2.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_5.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_6.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_6.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_1.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_2.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_5.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_6.jpg?1681805246631", "https://bizweb.dktcdn.net/100/437/253/themes/878768/assets/feedback_6.jpg?1681805246631"]
        }
    },
    methods:{
        HandleSeclect(index){
            this.spanIndex= index
        }
        
    }
}
</script>

<style lang="scss" scoped>
.SectionFeedback::before {
    content: '';
    display: block;
    width: 100%;
    z-index: -10000;
    height: 100%;
    position: absolute;
    background-image: url('https://bizweb.dktcdn.net/100/423/630/files/background-feedback.jpg?v=1640052884750');
    background-color: rgba(141, 140, 140, 0.9);
    filter: grayscale(100%);

}
</style>