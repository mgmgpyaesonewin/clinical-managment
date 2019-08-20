<script>
export default {
    mounted(){

    }
}
</script>a<template>
  <input type="text" 
    :class="{'is-invalid': error ? true : false}" 
    class="form-control timepicker" 
    placeholder="Enter User Date of Birth" >
</template>

<script>
export default {
  props:['time','error'],
  mounted(){
          $(this.$el).bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false })
           .on(
            "change", () => {
              this.$emit('testing',$('.timepicker').val())
              }
        	);
          ;
    },
    beforeDestroy() {
    }
}
</script>
