<template>
  <div class>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Appointment</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
        </div>
      </div>
    </div>
    <!-- <keep-alive> -->
    <component :current.sync="current" :is="current"></component>
    <!-- </keep-alive> -->
  </div>
</template>

<script>
import day from "./View";
import week from "./AppointmentWeek";
export default {
  components: {
    day,
    week
  },
  data() {
    return {
      current: "day"
    };
  }
};
</script>