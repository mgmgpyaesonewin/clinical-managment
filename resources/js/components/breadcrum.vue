<template>
    <div>
    <ol class="breadcrumb">
        <li v-for="(link,index) in this.$store.state.breadcrum" :key="index" class="breadcrumb-item ">
            <router-link :to='"/"+link'>{{link.toUpperCase()}}</router-link>
        </li>
    </ol>
    </div>
</template>
<script>
export default {
    
}
</script>