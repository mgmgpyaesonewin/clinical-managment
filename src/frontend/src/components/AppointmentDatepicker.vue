<template>
  <input
    type="text"
    :class="[ename,error ? true : false]"
    class="form-control"
    autocomplete="off"
  />
</template>

<script>
export default {
  props: ["error","ename",'startDate'],
  mounted() {
    console.log(this.ename)
    let self = this;
    $(this.$el)
      .datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        startDate: this.startDate
      })
      .on("changeDate", ({ date }) => {
        self.$emit(this.ename, date);
      });
  },
  beforeDestroy() {
    $(this.$el)
      .datepicker("hide")
      .datepicker("destroy");
  }
};
</script>
