<template>
<div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <!-- <div class="col-4">
                <h3>Add Services To Patients</h3>
            </div>
            <div class="col-12 row mb-4">
                <div class="col-6">
                    <label for="pateint" style="font-size:20px">Patient</label>
                 <user-picker   class="col-12"  :patientId.sync="patientId"/>
                </div>         
            </div> -->
                
                   <div class="col-6 " >
                        <h3 class="col-12 ">Daily Services</h3> 
                                           <div class="col-12 row mb-4">
                        <div class="col-4">
                            <label for="pateint" style="font-size:20px">Date:</label>
                        </div>
                        <div class="col-8">
                          <datepicker :disabled="this.hasDs.hasOwnProperty('start_date')" :value="datefordailyservice" startDate="" class="col-12" ename="pickdate2" @pickdate2="setDate2"/>
                        </div>
                </div> 
                       <div class="row">
                        <servicepicker :multiple=true class="col-9 ml-2" @multi="insert" forevent="multi" :service.sync="multiservice"/>
                        <button  @click="submitdailyservice()" class="btn btn-success col-2">Add</button>
                       </div>
                     
                       
                     <div class="col-sm-12 mt-4">
                        <div class="card">
                        <div class="card-body">
                            <ul>
                             <div class="row">
                                <div class="col-5">Name</div>
                                <div class="col-5">Price</div>
                                <div class="col-2 text-right">Action</div>
                            </div>
                            <li class="row" v-for="data in hasDs.services" :key="data.id">
                             <div class="col-5">  {{data.name}}</div>
                                <div class="col-5">{{data.price}}</div>
                                <div class="col-2">
                                    <button type="button" @click="removeDs(data.pivot)" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></div>
                            </li>
                        </ul>
                        </div>
                        </div>
                    </div>
                   </div>
                 <div class="col-6 ">     
                     <h3 class="col-12">Additional Services</h3> 
                   <!-- <hr class="row col-12"> -->
                   <div class="row">
                    <div class="col-12 row mb-4">
                        <div class="col-4 ml-2">
                            <label for="pateint" style="font-size:20px">Date:</label>
                        </div>
                        <div class="col-7">
                          <datepicker startDate="" class="col-12" ename="pickdate" @pickdate="setDate"/>
                        </div>
                </div> 
                          <servicepicker class="col-9 ml-2" :multiple="false" forevent="single"  @single="(e)=>{service=e}" :service.sync="service"/>
                            <button  @click="submitservice()" class="btn btn-success col-2">Add</button>
                   </div>
                 
                   <div class="col-sm-12 mt-4">
                    <div class="card">
                    <div class="card-body">
                        <ul>
                            <div class="row">
                                <div class="col-5">Name</div>
                                <div class="col-5">Price</div>
                                <div class="col-2 text-right">Action</div>
                            </div>
                            <li v-for="ads in hasAs" :key="ads.id" class="row">
                                <div class="col-5">  {{ads.service.name}}</div>
                                <div class="col-5">{{ads.service.price}}</div>
                                <div class="col-2">
                                    <button type="button" @click="removeAs(ads.id)" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></div>

                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                 </div> 
        </div>
    </div>



      
    </div>
    <hr class="row col-12" />
  </div>
</div>
</template>
<script>
// import userPicker from "../Patient/Patientpicker";
import datepicker from "../AppointmentDatepicker";
import servicepicker from "./servicepicker";
export default {
    components:{
        // userPicker,
        datepicker,servicepicker
    },
    data() {
        return {
            service:null,
            multiservice:[],
            datefordailyservice:null,
            date:null,
            hasAs:[],
            hasDs:[],

            
        }
    },
    computed:{
        checkNotNull(){
           return this.patientId && this.date ;
        },
        patientId(){
            return this.$store.state.patient
        }
    },
    watch:{
        patientId(){   
            console.log('asdasd')
                this.getAdditionalservices()
                this.getDailyService()

        },
        async date(){
                this.getAdditionalservices()
        },
        async datefordailyservice(){
                this.getDailyService()
        }
    },
    methods: {
    
      async  removeDs(pivot){
            try {
                await axios.delete(`servicegroups`,{params:pivot})
                this.getDailyService()
            } catch (error) {
                console.log(error)
            }
        },
        async removeAs(id){

            try {
                await axios.delete(`additionalservices/${id}`)
                this.getAdditionalservices()

            } catch (error) {
                console.log(error)
            }
            },
        async getDailyService(){
            console.log('called')
        if(this.patientId ){
            try {
            const {data}= await axios.get(`dailyservices`,{params:{
            id:this.patientId.id,
            }})
            this.hasDs=data.length!==0 ? data[0] :{};
            console.log(this.hasDs.hasOwnProperty('start_date'))
            if(this.hasDs.hasOwnProperty('start_date')){
                    console.log(this.hasDs)
                    this.setDate2(this.hasDs.start_date)
            }
            this.multiservice= data.length!==0 ?  data[0].services :[]
            // console.log(data)
            } catch (error) {
                console.log(error)
            }

        }
        },
        async getAdditionalservices(){
        if(this.checkNotNull){
            try {
            const {data}= await axios.get(`additionalservices`,{params:{
            id:this.patientId.id,
            date:this.date,
            }})
            this.hasAs=data
            console.log(data)
            } catch (error) {
                console.log(error)
            }

        }
        },
        insert(e){
           this.multiservice=e
        },
        submitservice(){
            console.log(this.service)
            axios.post('additionalservices',{
                patient_id:this.patientId.id,
                service_id:this.service.id,
                price: this.service.price,
                date:this.date
            })
            .then((res)=>{
                this.getAdditionalservices()
                console.log(res.data)
            })
            .catch(err=>{
                console.log(err)
            })
        },
        submitdailyservice(){
            if(this.hasDs.hasOwnProperty('id')){
                console.log('hasDs')
            var services=this.multiservice.map((m)=> {
                return {
                    service_id:m.id,
                }
            })    
            var data ={
                patient_id:this.patientId.id,
                start_date:this.datefordailyservice,
                user_id:this.$store.state.user.data.id,
                services
            }    
            axios.patch(`dailyservices/${this.hasDs.id}`,data)
            .then((res)=>{
                console.log(res.data)
            })
            .catch(err=>{
                console.log(err)
            })
            }
            else{
            console.log('hasnoDs')
            var newservices=this.multiservice.map((m)=> {
                console.log(this.$store.state.user.data)
                return {
                    service_id:m.id,
                    user_id:this.$store.state.user.data.id
                }
            })
            var newdata ={
                patient_id:this.patientId.id,
                start_date:this.datefordailyservice,
                services:newservices
            }
             axios.post('dailyservices',newdata)
            .then((res)=>{
                console.log(res.data)
            })
            .catch(err=>{
                console.log(err)
            })
            }

        this.getDailyService()

        },
        setDate(date){
            this.date= moment(date).format("YYYY-MM-DD")
        },
        setDate2(date){
            this.datefordailyservice= moment(date).format("YYYY-MM-DD")
        }
    },
    async mounted(){
        this.getDailyService()

    }
  };
</script>