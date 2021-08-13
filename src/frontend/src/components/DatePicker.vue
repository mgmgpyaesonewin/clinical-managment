<template>
  <input
    type="text"
    :class="{'is-invalid': error ? true : false}"
    class="form-control mydatepicker"
    autocomplete="off"
  />
</template>

<script>
export default {
  props: ["error"],
  mounted() {
    let self = this;
    $(".mydatepicker")
      .datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        startDate: "dateToday"
      })
      .on("changeDate", ({ date }) => {
        self.$emit('')
        self.$emit("update-date", date);
      });
  },
  beforeDestroy() {
    $(".mydatepicker")
      .datepicker("hide")
      .datepicker("destroy");
  }
};
</script>
