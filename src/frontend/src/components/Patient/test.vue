<template>
    <div v-html="content"  > 
        
    </div>
</template>
<script>
export default {
    data(){
        return {
            content:''
        }
    },
  async  mounted(){
     const {data}=await axios.get('reportdocuments')
        this.content= data.content
        console.log(this.content)
    }
}
</script>