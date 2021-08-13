<template>
    <multiselect
                :value="service"
                :options="services"
                @input="insert"
                placeholder="Select one"
                label="name"
                :custom-label="customlabel"
                
                :multiple="multiple"
                 @open="open"

                track-by="name"
    ></multiselect>
</template>
<script>

import multiselect from 'vue-multiselect'
export default {
    props:['service','forevent','multiple'],
    data() {
        return {
            services:[],
        }
    },
    methods:{
        insert(event){
            this.$emit(this.forevent,event)
        },
        customlabel({name,price}){
            return `${name} - ${price}`
        },
        open(){
            if(!this.multiple){
                this.$emit(this.forevent,null)
            }
        }
        
    },
    components:{multiselect},
   async mounted() {
       const {data} = await axios.get('services')
        this.services = data;
    },
}
</script>