<template>
    <div>
        <div class="card mt-1" >
            <div class="card-body" style="font-size:13px;padding:0">
                <div class="row">
                    <div class="col-2">Date</div>
                    <div class="col-8">Text</div>
                    <div class="col-1">Doctor</div>
                    <div class="col-1">
                        <a v-b-modal.consult class="btn waves-effect waves-light btn-info" href="#">Edit</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 " style="font-size:12px;">
                        {{formattedDate(consultation.created_at)}}
                    </div>
                    <div class="col-8">
                        Title : {{consultation.title}}, Comment : {{consultation.comment}}
                    </div>
                    <div class="col-2">
                        {{consultation.doctor.name}}
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
            </div>
            <pcitabs/>
            <hr style="width:100%">
        </div>
 <iform
ref="invest"
/>
<cform
:consult="consultation"
@submitform="updateConsult()"
/>
    </div>
</template>
<style lang="css">
.sticky-offset {
    top: 100px;
}

</style>
<script>
import pcitabs from './PCITabs'
import {VBModal } from 'bootstrap-vue'
import cform from './Form'
import iform from '../Investigation/Form'
import pcicard from './PCICard'
export default {
    components:{
        pcicard,iform,cform,pcitabs
    },
    directives:{
      'b-modal':VBModal
    },
    data(){
        return{
            consultation:{
                title:null,
                doctor:{
                    name:null,
                },
                comment:null,
            }
        }
    },
    methods:{
        InvestOpen(){
            console.log(this.$refs.invest)
            this.$refs.invest.$children[0].show()
        },
        formattedDate(date){
              return moment(date).format('MMMM Do YYYY, h:mm a');     
        },
        updateConsult(){
            axios.put(`consultations/${this.$store.state.consult}`,this.consultation)
            .then((res)=>{
                  this.$toasted.show('Success !')
                this.consultation=res.data
            })
            .catch((err)=>{
                this.errors=error.response.data;
                console.log(error.response.data);
            })
        }
    },
    mounted(){
        axios.get(`consultations/${this.$store.state.consult}?id=${this.$route.params.id}`)
        .then((res)=>{
            this.consultation=res.data
            })
        .catch((err)=>console.log(err))
    }
}
</script>