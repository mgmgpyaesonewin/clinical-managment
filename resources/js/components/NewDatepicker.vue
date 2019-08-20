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
      $(".mydatepicker").bootstrapMaterialDatePicker({ weekStart: 0, time: false })
      .on(
     		"change", () => {
           this.$emit('testing',$('.mydatepicker').val())
           }
		);
    },
}
</script>
