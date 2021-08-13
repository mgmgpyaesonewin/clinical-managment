<template>
  <div class>
    <div v-if="$store.getters.isTokenValid">
      <Topnav></Topnav>
      <Sidebar></Sidebar>
      <div class="row mt-1">
        <patient-navbar />
      </div>
      <div class="page-wrapper">
        <div class="container-fluid">
          <router-view></router-view>
        </div>
      </div>
      <footer class="footer">© 2019 BRS Clinical System</footer>
    </div>
    <div v-else>
      <div class="container-fluid">
        <Auth />
      </div>
    </div>
  </div>
</template>
<script>
import Auth from "./User/Auth";
import Topnav from "./Nav.vue";
import Sidebar from "./Sidebar.vue";
import PatientNavbar from "./Patient/PatientNavbar";
export default {
  components: {
    PatientNavbar,
    Topnav,
    Auth,
    Sidebar
  }
};
</script>
<style scoped>
.footer {
  margin-left: 0px;
}
</style>
