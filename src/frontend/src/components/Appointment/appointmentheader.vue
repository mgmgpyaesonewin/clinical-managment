<template>
     <div class="col-12 justify-content-center text-center">
                              <h4 class="card-title">Search Appointment</h4>              

                <button :disabled="check('week')" @click.prevent="handle($event.target.value)" value="day" class="btn btn-success mr-1">Day</button>
                <button :disabled="check('day')"  @click="handle($event.target.value)" value="week"  class="btn btn-info">Week</button>
 </div>
</template>
<script>
export default {
     props:['current'],
     methods:{
          handle(event){
      this.$emit("handle",event)
    },
    check(name){
         console.log(this.current)
         return this.current !== name
    }
     }
}
</script>