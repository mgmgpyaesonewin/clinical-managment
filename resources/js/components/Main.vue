<template>
<div class="">
    <div v-if="$store.getters.isTokenValid" class="s">
       <Topnav></Topnav>
       <Sidebar></Sidebar>
        <div class="page-wrapper">
          <div class="container-fluid">
              <router-view></router-view>
          </div>
        </div>
    </div>
     <div v-else class="s">
          <div class="container-fluid">
             <Auth/>
          </div>
     </div>
</div>
</template>
<script>
import Auth from './User/Auth'
import Topnav from './Nav.vue';
import Sidebar from './Sidebar.vue';

    export default {
        components:{
            Topnav,
            Auth,
            Sidebar,
        },
        mounted() {
        }
    }
</script>
