<template>
  <input type="text" 
    :class="{'is-invalid': error ? true : false}" 
    v-model="endate" 
    class="form-control mydatepicker2" 
    placeholder="Enter User Date of Birth" >
</template>

<script>
export default {
  props:['endate','error'],
  mounted(){
      $(".mydatepicker2").bootstrapMaterialDatePicker({ weekStart: 0, time: false })
      .on(
     		"change", () => {
           this.$emit('enddate',$('.mydatepicker2').val())
           }
		);
    },
}
</script>
