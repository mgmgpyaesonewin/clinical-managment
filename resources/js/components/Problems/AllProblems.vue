<template>
    <div>
        <div class="row">
            <div class="col-11">
                <h4>All Problems</h4>
            </div>
            <div class="col-1">
                <a v-b-modal.exam-add href="#" class="btn waves-effect waves-light btn-primary">Add</a>
            </div>
            
           <div class="col-12" style="overflow-y:scroll;height:450px" >
                <hr style="width:100%" >
                <div v-for="problem in problems" :key="problem.id" class="row">
                    <div class="col-3">
                        <div class="col-12">Name - {{problem.name}}</div>
                        <div class="col-12">Code -{{problem.code}}</div>
                    </div>
                    <div class="col-2">
                        <div class="col-12">Type - {{problem.type}}</div>
                        <div class="col-12">Status -{{problem.status}}</div>
                    </div>
                    <div class="col-3">
                        <div class="col-12">Start Date - {{problem.start_time}}</div>
                        <div class="col-12">End Date - {{problem.end_time}}</div>
                    </div>
                    <div class="col-2">
                        <div class="col-12">Authorizer</div>
                        <div class="col-12">{{$store.state.user.data.name}}</div>
                    </div>
                    <!-- <div class="col-2 row">
                        <div class="col-6"><a class="btn waves-effect waves-light btn-info" href="#" v-b-modal.invest-edit  @click="bindbyid(c.id)">Edit</a></div>
                        <div class="col-6"><a class="btn waves-effect waves-light btn-danger" @click.prevent="deleteInvestigation(c.id,index)" href="#" >Delete</a></div>
                    </div> -->
                    <hr style="width:98%">
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
        axios.get('problems')
        .then(response => {
            this.problems = response.data;
        });
    } 
}
</script>