<template>
    <div>
        <div class="row">
            <div class="col-11">
                <h4>All Problems</h4>
            </div>
            <div class="col-1">
            </div>
            
           <div class="col-12"  >
                <hr style="width:100%" >
                <div v-for="(type,i,ind) in problems" :key="ind" class="row">
                        <div v-for="(status,s,inde) in type " :key="inde" class="col-12">

                        <h4 class="ml-2 mb-2 col-12">({{i}},{{s}})</h4>
            
                     <div v-for="(problem) in status" :key="problem.id" class="col-12 row">

                            <div class="col-3">
                                <div class="col-12">Name - {{problem.name}}</div>
                                <div class="col-12">Code -{{problem.code}}</div>
                            </div>
                            <div class="col-3">
                                <div class="col-12">Type - {{problem.type}}</div>
                                <div class="col-12">Status -{{problem.status}}</div>
                            </div>
                            <div class="col-3">
                                <div class="col-12">Start Date - {{problem.start_time}}</div>
                                <div class="col-12">End Date - {{problem.end_time}}</div>
                            </div>
                            <div class="col-3">
                                <div class="col-12">Authorizer</div>
                                <div class="col-12">{{$store.state.user.data.name}}</div>
                            </div>
                            <hr style="width:98%">
                        </div> 
                     </div>

                </div>


            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    data () {
        return {
            problems : []
        }
    },
    mounted () {
        axios.get(`problemsPerPatient/${this.$store.state.patient.id}`)
            .then(response => {
                this.problems = response.data;
                console.log(this.problems)
            });
    } 
}
</script>