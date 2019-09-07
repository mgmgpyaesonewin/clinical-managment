<template>
    <div >
        <div class="card mt-1">
            <div class="card-body" style="font-size:13px;padding:0">
                <div class="row">
                <div class="col-2">
                  Date
                </div>
                <div class="col-8">
                  Text
                </div>
                <div class="col-1">Doctor</div>
                <div class="col-1 ">
                    <a @click.prevent="alert()" class="btn btn waves-effect waves-light btn-primary" href="">New</a>
                </div>
                </div>
                <div class="row hover" @click="changetab(consultation.id)"
                  v-for="consultation in consultations" :key="consultation.id" >
                 <div class="col-2 " style="font-size:12px" >
                 {{formattedDate(consultation.created_at)}}
                </div>
                <div class="col-8">
                  <div><a href="#">Title : {{consultation.title}}, Comment : {{consultation.comment}}</a></div>
                </div>
                <div class="col-2">
                    {{consultation.doctor.name}}
                </div>
                <div style="font-size:12px" class="col-12">Investigation-</div>
                <div style="font-size:12px" class="col-12">Medication</div>
                <div style="font-size:12px" class="col-12">Problems</div>
                  <hr style="width:100%;padding:0;margin:0">
                </div>          


                </div>
                
        </div>
        <consultform
ref="consult"
:consult.sync="consult"
:consultations.sync="consultations"
@submitform="formsubmit()"
/>
    </div>
</template>
<style lang="css">
.hover:hover{
    background-color: #f8f9fa;
}
</style>
<script>
import consultform from '../Consultation/Form';
import moment from 'moment';
import {BButton} from 'bootstrap-vue'
export default {
    components:{
        consultform,BButton
    },
    data(){
        return{
            consult:{
                comment:null,
                title:null,
                patient_id:this.$route.params.id
            },
            consultations:[]
        }
    },
    computed:{
            
    },
    methods:{
    formsubmit(){
        console.log(this.consult)
        axios.post('consultations',this.consult)
        .then((res)=>{
            this.$toasted.show('Success !')
            this.consultations.unshift(res.data)
        })
        .catch((err)=>{
        this.errors=err.response.data;
        console.log(err.response.data)
        })
      }  ,
        changetab(id){
            this.$store.commit('setConsult',id)
            this.$emit('setTab')
        },
      alert(){
            this.$refs.consult.$children[0].show()
      },
      formattedDate(date){
       return moment(date).format('MMMM Do YYYY, h:mm a');     
    }
    },
    mounted(){
        axios.get(`consultations?id=${this.$route.params.id}`)
        .then((res)=>{
            this.consultations=res.data
            })
        .catch((err)=>console.log(err))
    }
}
</script>