<template>
    <div class="col-12 justify-content-center ">
<div :key="index" v-for="(value,name,index)   in patient" >
    <div class="row">
            <div class="col-5 text-capitalize font-weight-bold">
               {{name}}
            </div>
            <div class="col-2">:</div>
            <div class="col-5"> {{value}}</div>
        </div>
</div>
    </div>
    
</template>

<script>

export default {
    data(){
        return {
            patient:{}
        }
    },
    async created(){
    console.log(this.$route.params)
      let res= await  axios.get(`patients/${this.$route.params.id}`)
    this.patient=res.data
     }
}
</script>