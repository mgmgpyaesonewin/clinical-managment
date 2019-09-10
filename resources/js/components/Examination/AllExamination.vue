<template>
    <div>
        <div class="row">
            <div class="col-11">
                <h4>All Examinations</h4>
            </div>
            <div class="col-1">
                <a v-b-modal.exam-add href="#" class="btn waves-effect waves-light btn-primary">Add</a>
            </div>
            
            <div class="col-12" style="overflow-y:scroll;height:500px;" >
                <hr style="width:100%" >
                <div v-for="examination in examinations" :key="examination.id" class="row">
                    <div class="col-5">
                        <div class="col-12">Term - {{examination.term}}</div>
                        <div class="col-12">Value -{{examination.value}}</div>
                    </div>
                    <div class="col-2">
                        <div class="col-12">Range</div>
                        <div class="col-12">{{examination.range}}</div>
                    </div>
                    <div class="col-3">
                        <div class="col-12">Code:{{examination.code}}</div>
                        <div class="col-12">Snomed CT:{{examination.snomed_ct}}</div>
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
            examinations : []
        }
    },
    mounted () {
        axios.get('examinations ')
        .then(response => {
            this.examinations = response.data;
        });
    } 
}
</script>