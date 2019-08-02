<template>
    <div class="s">
       <Topnav></Topnav>
       <Sidebar></Sidebar>
        <div class="page-wrapper">
       
          <div class="container-fluid">
              asdasd
          </div>
        </div>
    </div>
</template>

<script>
import Topnav from './Nav.vue';
import Sidebar from './Sidebar.vue';

    export default {
        components:{
            Topnav,
            Sidebar,
        },
        mounted() {
            console.log(this.$router.history)
            console.log('Component mounted.')
        }
    }
</script>
