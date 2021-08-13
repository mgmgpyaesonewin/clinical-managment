<template>
    <div class="row">
        
    <div class="row col-12">
        
            <div class="col-11">
            <h2>Sevices </h2>
                </div>

        <div class="col-1">
            <button class="btn btn-info"
        v-b-modal.service-add> Add
        </button>
               </div>
    <hr class="row" style="width:100%">
      
        <table class="table table-striped   mt-3">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Created Date</th>
                <th scope="col">Action</th>
                </tr>
               
            </thead>
            <tbody>
                <tr v-for="s in services" :key="s.id">
                <td>{{s.name}}</td>
                <td>{{s.price}}</td>
                <td>{{s.created_at}}</td>
                <td>
                    <a href="#"  v-b-modal.service-edit @click="bindService(s.id)" class="fa fa-edit"></a>
                    <a href="#" @click="deleteservice(s.id)" class="fa fa-trash"></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <sform
    :errors="errors"
    @hide="resetService()"
     modal="service-add" 
     @formsubmit="formsubmit()"
    :service="service"/>
    <sform
    :errors="errors"
    @hide="resetService()"
     modal="service-edit" 
     @formsubmit="updateservice()"
    :service="service"/>
    </div>
</template>
<script>
import sform from './form'
import {VBModal} from 'bootstrap-vue'
export default {
      directives: {
    "b-modal": VBModal,
  },
components:{
    sform,
},
    data() {
        return {
            errors:{},
            service:{
                name:null,
                price:null,
                hospital_id:this.$store.state.user.data.hospital_id,
            },
            services:[]
        }
    },
    methods: {
      async  getServices(){
         const {data} = await axios.get('services')
        this.services=data
        },
        bindService(id){
            this.service=this.services.find(s=> s.id==id)
        },
        resetService(){
            this.service={
                name:null,
                price:null,
                hospital_id:this.$store.state.user.data.hospital_id,
            }
        },
        deleteservice(id){
            axios.delete(`services/${id}`)
            .then((res)=>{
                console.log(res)
                this.getServices()
            })
            .catch(err=>console.log(err.response.data))
        },
        updateservice(){
            console.log('from update')
            axios.put(`services/${this.service.id}`,this.service)
            .then(res=>console.log(res))
            .catch(err=>console.log(err))
        },
        formsubmit(){
            console.log('from submit')
            axios.post('services',this.service)
            .then((res)=>{
                this.getServices()

                console.log(res)
            })
            .catch(err=>{
                console.log(err.response.data)
                this.errors=err.response.data
                })
        }
    },
     mounted(){
       this.getServices()
    }
  
}
</script>