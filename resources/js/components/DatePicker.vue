<template>
  <input type="text" 
    :class="{'is-invalid': error ? true : false}" 
    v-model="date" 
    class="form-control mydatepicker" 
    placeholder="Enter User Date of Birth" >
</template>

<script>
export default {
  props:['date','error'],
  mounted(){
      console.log($('.mydatepicker').datepicker({
        format:'dd-mm-yyyy'
      }));
      $(this.$el).datepicker();
    },
    beforeDestroy() {
        $(this.$el).datepicker('hide').datepicker('destroy');
    }
}
</script>
