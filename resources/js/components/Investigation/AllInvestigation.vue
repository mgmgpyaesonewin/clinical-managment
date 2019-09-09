<template>
    <div>
        <div class="row">
            <div class="col-11">
                <h4>All Invenstigations</h4>
            </div>
            <div class="col-1">
                <a v-b-modal.exam-add href="#" class="btn waves-effect waves-light btn-primary">Add</a>
            </div>
            
            <div class="col-12" style="overflow-y:scroll;height:500px;" >
                <hr style="width:100%" >
                <div v-for="investigation in investigations" :key="investigation.id" class="row">
                    <div class="col-5">
                        <div class="col-12">Term - {{investigation.term}}</div>
                        <div class="col-12">Value - {{investigation.value}}</div>
                    </div>
                    <div class="col-2">
                        <div class="col-12">Range</div>
                        <div class="col-12">{{investigation.range}}</div>
                    </div>
                    <div class="col-3">
                        <div class="col-12">Code: {{investigation.code}}</div>
                        <div class="col-12">Snomed CT: {{investigation.snomed_ct}}</div>
                    </div>
                    <!-- <div class="col-2 row">
                        <div class="col-6"><a class="btn waves-effect waves-light btn-info" href="#" v-b-modal.exam-edit  @click="bindbyid(c.id)">Edit</a></div>
                        <div class="col-6"><a class="btn waves-effect waves-light btn-danger" @click.prevent="deleteInvestigation(c.id)" href="#" >Delete</a></div>
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
            investigations : []
        }
    },
    mounted () {
        axios.get('investigations ')
        .then(response => {
            this.investigations = response.data;
        });
    } 
}
</script>