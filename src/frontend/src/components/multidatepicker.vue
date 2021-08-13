<template>
  <input type="text" 
    :class="{'is-invalid': error ? true : false}" 
    v-model="date" 
    class="form-control mydatepicker" 
   >
</template>

<script>
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker'
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
export default {
  props:['date','error','multi'],
  mounted(){
      var multidate=false
      if(this.multi==="session-add"){
          multidate=true;
      }
      $('.mydatepicker').datepicker({
        format:'yyyy-mm-dd',
        multidate: multidate,
      }).on('change',(event)=>{
          console.log(event.target.value)
         this.$emit('testing',$('.mydatepicker').val())
      })
    },
    beforeDestroy() {
      $(this.$el).datepicker('hide').datepicker('destroy');
    }
}
</script>
