<template>
  <div class="col-12 justify-content-center">
    <b-modal id="modalPopover" title="Modal with Popover" hide-footer>
      <div class="row justify-content-center">
        <div class="col-12 form-group row">
          <label class="col-4 mt-2 card-title" for="amount">Amount :</label>
          <input class="form-control col-8" type="number" v-model="deposit" name id />
        </div>
        <button @click="AddDeposit" class="btn btn-primary mb-3">submit</button>
      </div>
      <div class="modal-footer" scope="model-footer"></div>
    </b-modal>
    <div class="row">
      <div class="col-6">
        <div class="card card-content">
          <div class="card-header bg-info">
            <h4 class="m-b-0 text-white card-title">Profile</h4>
          </div>
          <div class="card-body">
            <div :key="index" v-for="(value,name,index) in patient">
              <div class="row">
                <div class="col-5 text-capitalize font-weight-bold">{{name}}</div>
                <div class="col-2">:</div>
                <div class="col-5">{{value}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-content col-6">
        <div class="card-body">
          <div class="row">
            <h5 class="card-title col-6">Deposit</h5>
            <a
              href="#"
              v-b-modal.modalPopover
              class="btn btn-primary card-title ml-auto"
            >Add Deposit</a>
          </div>
          <div class="row">
            <div class="col-12">
              <span class="mr-3">Amount :</span>
              <span class="ml-3">{{patient.deposit}}</span>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12" style="height:220px;overflow-y:auto" >
              <h5 class="card-title">Transition Activity</h5>
              <table class="table"  style="font-size:13px;">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Comment</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="t in transactions" :key="t.id" >
                    <td>{{t.created_at}}</td>
                    <td>{{t.cmt}}</td>
                    <td>{{t.amount}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="css">
 /* td,th{
    padding:8px !important;
  } */
</style>

<script>
import { BModal, VBModal } from "bootstrap-vue";
export default {
  components: {
    "b-modal": BModal
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      deposit: null,
      patient: {},
      transactions:[]
    };
  },
  methods: {
    async AddDeposit() {
      try {
        var res = await axios.put(`patients/${this.$route.params.id}/deposit`, {
          deposit: this.deposit
        });
        this.transactions= res.data.activity
        delete res.data.activity
         this.patient = res.data;
        this.deposit = null;
        this.$toasted.show("Success !");
      } catch (error) {
        console.log(error);
      }
    }
  },
  async created() {
    console.log(this.$route.params);
    let res = await axios.get(`patients/${this.$route.params.id}`);
    this.transactions= res.data.activity
    delete res.data.activity
    this.patient = res.data;
    console.log(res.data)
  }
};
</script>