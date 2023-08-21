<template>
    <section class=" section_service -mt-8 z-10 flex justify-center ">
        <div class="max-w-6xl bg-[#3f3fdb] py-6 flex justify-center ">
            <ul class=" flex max-w-6xl text-center justify-around ">
                <li class="px-10" v-for="(icon, index) in listIcons" :key="index">
                    <div class="flex justify-center mb-4">
                        <img :src=icon.Img_url alt="icon service" srcset="">
                    </div>
                    <h4 class="text-xs font-medium">{{ icon.tile }}</h4>
                    <p class="text-[12px]">{{ icon.info }}</p>
                </li>
            </ul>
        </div>

    </section>
</template>

<script>
export default {
    data() {
        return {
            listIcons: [
                {
                    Img_url: "//bizweb.dktcdn.net/100/437/253/themes/878768/assets/icon_service_1.svg?1681805246631",
                    tile: "Giao hang toan quoc",
                    info: "Mien phi van chuyen cac don hang gia tri tren 2.000.000D"

                },
                {
                    Img_url: "//bizweb.dktcdn.net/100/437/253/themes/878768/assets/icon_service_1.svg?1681805246631",
                    tile: "Giao hang toan quoc",
                    info: "Mien phi van chuyen cac don hang gia tri tren 2.000.000D"

                },
                {
                    Img_url: "//bizweb.dktcdn.net/100/437/253/themes/878768/assets/icon_service_1.svg?1681805246631",
                    tile: "Giao hang toan quoc",
                    info: "Mien phi van chuyen cac don hang gia tri tren 2.000.000D"

                },
                {
                    Img_url: "//bizweb.dktcdn.net/100/437/253/themes/878768/assets/icon_service_1.svg?1681805246631",
                    tile: "Giao hang toan quoc",
                    info: "Mien phi van chuyen cac don hang gia tri tren 2.000.000D"

                },
            ]
        }
    }
}
</script>

<style lang="scss" scoped></style>