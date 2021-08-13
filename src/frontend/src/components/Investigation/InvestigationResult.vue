<template>
    <div style="background-color:white;">
            <div class="row" >
                <div class="col-8 "  v-show="!loading">
                    <div class="row">
                <div class="col-6 mt-3 ">
                    <div class="row">
                    <div class="col-6">
                          <h4 class="ml-2">All investigations</h4>
                    </div>
                    <div class="col-6">
                          <select  @change="fetchData()" class="form-control" v-model="params.status" id="">
                          <option  v-for="s in statusoption" :key="s.name" :value="s.value">
                              {{s.name}}
                          </option>
                      </select>
                    </div>
                    </div>  
                </div>
                    <div class="col-6  mt-3 form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" id="search" autofocus ref="test" v-model="params.search" class="form-control" placeholder="Search Patient Name">
                </div>
            
                    </div>
               
               
                <div v-for="investigation in investigations" :key="investigation.id"  @click="bindById(investigation.id)" class="row click p-0 m-0">
                     <hr style="width:100%;margin:0" >
                    <div class="col-3">
                        <div class="col-12">Term - {{investigation.term}}</div>
                        <div class="col-12">Code - {{investigation.code}}</div>
                    </div>
                     <div v-if="checkpending(investigation.value)" class="col-6">
                        <span><img style="mix-blend-mode: multiply;width:80px;height:50px;background-color:transparent;" src="../../assets/images/hourglass.gif" alt="asdasd"> Pending....</span>
                    </div>
                    <div v-else class="col-6">
                        <div class="col-12">Value - {{investigation.value}}</div>
                        <div class="col-12">Range - {{investigation.range}}</div>       
                     </div>
                     <div class="col-3">
                        <div class="col-12 font-weight-normal" >{{investigation.patient.name}}</div>
                        <div class="col-12 font-weight-normal" >{{investigation.created_at}}</div>
                    </div>
                    <hr style="width:98%;margin:0">
                </div>

                </div>
                <div v-show="loading" class=" col-8 text-center iloading">
                    <!-- <img  src="../../assets/images/loading.gif" 
                    class="image"
                    style="mix-blend-mode: multiply;height:400px;width:400px"  alt=""> -->
                </div>
                <div class="mt-5 col-4" 
  >
                   <form class="form-material form-horizontal sticky-top">
                    <div class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6 " for="example-email">Patient 
                        </label>
                        <label class="col-md-6 " for="example-email"> {{invest.name}}
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Term
                        </label>
                        <div class="col-md-12">
                            <input disabled stype="text" v-model="invest.term" :class="{'is-invalid':  errors.term ? true : false}" class="form-control">
                            <div class="invalid-feedback">
                                {{errors.term && errors.term[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Value 
                        </label>
                        <div class="col-md-12">
                            <textarea v-model="invest.value" 
        
                            :class="{'is-invalid':  errors.value ? true : false}" 
                            class="tarea-none form-control test" placeholder="Enter Consult value" 
                            cols="30" rows="3">
                            </textarea>
                            <div class="invalid-feedback">
                                {{errors.value && errors.value[0]}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Code 
                        </label>
                        <div class="col-md-12">
                            <input type="text" disabled v-model="invest.code" :class="{'is-invalid':  errors.code ? true : false}" class="form-control">
                            <div class="invalid-feedback">
                                {{errors.code && errors.code[0]}}
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                        <label class="col-md-12" for="example-email"> Range 
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="invest.range" :class="{'is-invalid':  errors.range ? true : false}" class="form-control" placeholder="Enter Consult value">
                            <div class="invalid-feedback">
                                {{errors.range && errors.range[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12  text-center">                 
                       <button @click.prevent="submitform()" type="submit" class="btn  btn-info waves-effect waves-light m-r-10">Submit</button>            
                    </div>
                        </form> 
                </div>
               
            </div>

    </div>
</template>
<style >
.iloading{
    background-image:url('../../assets/images/loading.gif');
    background-repeat: no-repeat;
    width:400px;
    background-position: center;
    height:400px;
}
.side-form{
    background-color:aliceblue; 
    position:fixed;
    top:110px;
    right:30px;
}
.tarea-none{
    background-image: none !important;

}
.tarea-none:focus{
    border-bottom: 1px solid #fb9678 !important;
    transition: background 0s ease-out 0s;
    transition-duration: 1s;
    background-position: center bottom,center calc(100% - 1px);
}
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
.sticky-top{
    top:100px !important;
}
.click:hover{
    background-color:#f5fafb;
}
.glass{
    widows: 50px;
    height: 50px;
    background-image: '../assets/images/hourglass.gif'
};
</style>
<script>
import iform from './Irequestform'
import { debounce } from "debounce";
import {VBModal } from 'bootstrap-vue'

export default {
    components:{
        iform
    },
    data () {
        return {
            loading:true,
            params:{
                status: null,
                search: null,
            },
            statusoption:[
                {
                    name:'all',
                    value:'',
                },
                {
                    name:'pending',
                    value:'pending',                    
                },
                {
                    name:'completed',
                    value:'completed',
                }
                    ],
            investigations : [],
            invest:{
                term:null,
                doctor_id:this.$store.state.user.data.id,
                patient_id:this.$route.params.id,
                value:null,
                code:null,
                snomed_ct:null,
                range:null,
            },
            errors:{}
        }
    },
    directives:{
    'b-modal':VBModal
    },
    computed:{
        searchquery(){
            return this.params.search;
        }
    },
    watch:{
        searchquery(value){
            this.callDebounce();
        }
    },
    methods:{
        bindById(id){
            this.invest=this.investigations.find((c)=>c.id===id)
        },
        checkpending(value){
            return value===null;
        },
        fetchData(){
        this.loading=true;
        const params=this.params;
        axios.get(`investigations`,{params})
        .then(response => {
            this.loading=false;
            this.investigations = response.data;
            this.setfocus();
        });
        },
        setfocus(){
            setTimeout(() => {
              document.getElementById("search").focus();
            }, 0);
        
        },
        submitform(){
            // console.log(this.invest);
            if(!this.invest.id){
                return alert('please select an request');
            }
            axios.put(`investigations/${this.invest.id}`,this.invest)
            .then((res)=>{
                this.$toasted.show('Success !')
                console.log(res.data)
                this.invest={
                term:null,
                doctor_id:this.$store.state.user.data.id,
                patient_id:null,
                value:null,
                code:null,
                snomed_ct:null,
                range:null,
            }
                // this.investigations.unshift(res.data)
                
            })
            .catch((err)=>{
                this.errors=err.response.data
            })
         },
         callDebounce(){
             
         }
    },
    mounted () {
        this.callDebounce=debounce(this.fetchData,400);
        this.fetchData();
    } 
}
</script>