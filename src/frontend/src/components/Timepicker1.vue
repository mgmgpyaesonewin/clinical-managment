<template>
  <input type="text" 
    :id="name"
    :class="{'is-invalid': error ? true : false}" 
    class="form-control timepicker" 
    placeholder="Enter User Date of Birth" >
</template>

<script>
export default {
  props:['error','name'],
  mounted(){
          $(this.$el).bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false })
           .on(
            "change", () => {
              console.log(`testing-${this.name}`)
              this.$emit(`testing`,$(`#${this.name}`).val())
              }
        	);
    },
}
</script>
