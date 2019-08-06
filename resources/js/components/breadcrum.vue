<template>
    <div>
    <ol class="breadcrumb">
        <li v-for="(link,index) in this.$route.matched" :key="index" class="breadcrumb-item ">
                        
            <router-link  :to='link.path'>{{link.meta.name}}</router-link>

        </li>
    </ol>
    </div>
</template>
<script>
export default {
    mounted(){
        // console.log(this.$route.matched)
    }
}
</script>