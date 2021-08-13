<template>
  <div class="row mt-4">
    <div class="col-11">
      <h3>Sessions</h3>
    </div>
    <div class="col-1">
      <a class="btn btn-info" @click="resetSession()" v-b-modal.session-add href="#">ADD</a>
    </div>
    <hr style="width:100%" />
    <sform :session="session" id="session-add" @submitform="formsubmit()" :errors="errors" />
      <sform :session="session" id="session-edit" @submitform="updateSession()" :errors="errors" />

    <div class="col-4" v-for="s in sessions" :key="s.id">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <div class="card-title row">
             <h5 class="col-6">Date {{s.date}}</h5> 
             <div class="col-6">
                 <a class="col-6" href="#" v-b-modal.session-edit @click="bindbyid(s.id)">edit</a>
             <a class="col-6" @click="deletebyid(s.id)" href="#" >delete</a>
             </div>
           
          </div>
          <span class="card-text text-warning">Minutes per Session - {{s.interval}} Minutes</span>
          <br />
          <span href="#" class="text-info">Start Time - {{s.start_time}}</span>
          <br />
          <span href="#" class="text-info">End Time - {{s.end_time}}</span>
          <br>
          <span href="#" class="text-info">Comment - {{s.cmt}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VBModal } from "bootstrap-vue";
import sform from "./SessionForm";

export default {
  name: 'Sessions',
  components: {
    sform
  },
  data() {
    return {
      session: {
        date: null,
        start_time: null,
        end_time: null,
        interval: null,
        cmt: null,
        intervals: null,
        doctor_id: this.$store.state.user.data.id
      },
      sessions: [],
      errors: {}
    };
  },
  directives: {
    "b-modal": VBModal
  },
  methods: {
    resetSession(){
      this.session={
        start_time: null,
        end_time: null,
        interval: null,
        cmt: null,
        intervals: null,
        doctor_id: this.$store.state.user.data.id
      }
    },
    bindbyid(id){
            this.session=this.sessions.find((c)=>c.id===id)
            console.log(this.session)
    },    
    formsubmit() {
      axios
        .post("sessions", this.session)
        .then(res => {
          this.$toasted.show("Success !");
          this.fetchdata();
        })
        .catch(err => {
          this.errors = err.response.data;
        });
    },
    async fetchdata(){
       const { data } = await axios.get(
      `sessions?id=${this.$store.state.user.data.id}`
    );
    this.sessions = data;
    },
    updateSession(){
      const {id}= this.session
      axios.put(`sessions/${id}`,this.session)
       .then(res => {
          this.$toasted.show("Success !");
        })
        .catch(err => {
          this.errors = err.response.data;
        });
    },
    deletebyid(id){
      axios.delete(`sessions/${id}`)
      .then((res)=>{
        this.sessions=this.sessions.filter((s)=>{
               return s.id != id
        })
      })
      .catch(err=>console.log(err))
    }
  },
  mounted() {
    this.fetchdata()
  }
};
</script>
