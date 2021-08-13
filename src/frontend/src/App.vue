<template>
  <div id="app">
    <MainVue/>
  </div>
</template>

<style>

@import url('css/subtemplate/template/app.css');
@import url('css/subtemplate/template/custom.css');
@import url('css/subtemplate/template/responsive.css');
@import url('css/subtemplate/template/tab-page.css');
@import url('css/subtemplate/template/variable.css');
@import url('css/subtemplate/template/style.min.css');
</style>

<script>
import './js/jquery-3.2.1.min.js'
import './js/template/sidebarmenu.js'
import './js/template/custom.min.js'
import './js/waves.js'
import './js/template/bootstrap-datepicker.min.js'
import './js/template/perfect-scrollbar.jquery.min.js'

import MainVue from './components/Main.vue'

export default {
  name: "App",
  components:{MainVue}
}
</script>
