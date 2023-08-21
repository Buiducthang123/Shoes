<template>
    <div class="filter-sort ">
        <h2>Sắp xếp</h2>
        <ul>
            <li class="flex items-center c" v-for="(item, index) in SortedBy" :key="index"
           
            >
            <label :for="index"  @click="HandleSelectSort(index)" class="w-full cursor-pointer">
                <input type="radio" :id="index" name="sort" class="mr-3" :checked="index===0?true:false">
               {{ item }}

            </label>
            </li>
        </ul>
    </div>
    <div>
        <h2>Thương hiệu</h2>

        <ul>
            <li class="" v-for="(item, index) in category" :key="index"><input type="checkbox" id="4"><label for="4" class="capitalize">{{ item }}</label></li>

        </ul>

    </div>
    <div>
        <h2>Kích thước</h2>
        <div class="">
            <ul class="grid grid-cols-4 gap-x-1 gap-y-3">
                <li class="border text-center px-3 py-2" v-for="(item, index) in sizes" :key="index"
                @click="HandleSelectSize(item.id)"
                :style="{ borderColor: sizeSelect === item.id ? 'red' : '#cdcbcb', color: sizeSelect === item.id ? 'red' : 'initial' }"
                >{{
                    item.name }}</li>
            </ul>

        </div>
    </div>
    <div>
        <h2>Màu sắc</h2>
        <ul class="grid grid-cols-6 gap-x-1 gap-y-3 mt-5">
            <li  v-for="(item, index) in colors" :key="colors.id" class="w-6 h-6 inline-block rounded-[50%]  tooltip cursor-pointer"
            :style="{ 'background-color': item.hex, borderColor: colorSelect === item.id ? 'red' : '#cdcbcb', color: colorSelect === item.id ? 'red' : 'initial',
            border: colorSelect === item.id ? '2px solid' : 'initial'

        }"
        @click="HandleSelectColor(item.id)"
        >
                <span class="tooltiptext">{{ item.name }}</span>

            </li>
        </ul>
    </div>

</template>

<script>
export default {

    props:['category','colors','sizes'],
    emits:['HandleSelectSort','HandleSelectSize','HandleSelectColor'],
    data() {
        return {
            SortedBy: ["Mặc định", "Tên A-Z", "Tên Z-A", "Giá thấp đến cao", " Giá cao đến thấp"],
           
            
            sizeSelect:null,
            colorSelect:null,


        }
    },
    methods:{
        HandleSelectSort(index){
            this.$emit('HandleSelectSort',index)
        },
        HandleSelectSize(id){
           
            if (this.sizeSelect==id) {
                this.sizeSelect=null
                this.$emit('HandleSelectSize', this.sizeSelect)
                return 0;
            }
            this.sizeSelect = id
            console.log('Size id : '+this.sizeSelect);
            this.$emit('HandleSelectSize', this.sizeSelect)
            
        },
        HandleSelectColor(id){
            if (this.colorSelect==id) {
                this.colorSelect=null
                this.$emit('HandleSelectColor',this.colorSelect)
                return 0;
            }
            this.colorSelect = id
            console.log('color id : '+this.colorSelect);
            this.$emit('HandleSelectColor',this.colorSelect)    
        }
    }

}
</script>

<style lang="scss" scoped>
*:not(h2) {
    color: #333;
    font-size: 13px;
}

h2 {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin: 8px 0;
}

li {
    padding: 8px 0;

}

label {
    margin-left: 10px;
}
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  /* Position the tooltip text */
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;

  /* Fade in tooltip */
  opacity: 0;
  transition: opacity 0.3s;
}

/* Tooltip arrow */
.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>