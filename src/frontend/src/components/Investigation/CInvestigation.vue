<template>
  <div class style="top:150px;font-size:12px;padding:0">
    <div class="row">
      <div class="col-11">
        <h4>All {{name}}</h4>
      </div>
      <div class="col-1">
        <a
          v-b-modal.invest-add
          href="#"
          class="btn waves-effect waves-light btn-primary"
          v-if="$can('create investigations')"
        >Add</a>
      </div>
      <hr style="width:100%" />

      <!-- <div v-for="c in investigations" :key="c.id" class="col-12">
            <a v-b-modal.invest-edit @click="bindbyid(c.id)"  href="#">edit</a>
      </div>-->
      <div class="col-12" style="overflow-y:scroll;height:450px">
        <div v-for="(c,index) in investigations" :key="c.id" class="row">
          <div class="col-4">
            <div class="col-12">Term - {{c.term}}</div>
            <div class="col-12">Value -{{c.value}}</div>
          </div>
          <div class="col-2">
            <div class="col-12">Range</div>
            <div class="col-12">{{c.range}}</div>
          </div>
          <div class="col-3">
            <div class="col-12">Code:{{c.code}}</div>
            <div class="col-12">Snomed CT:{{c.snomed_ct}}</div>
          </div>
          <div class="row col-2">
            <div class="col-6">
              <a
                class="btn waves-effect waves-light btn-info"
                href="#"
                v-b-modal.invest-edit
                @click="bindbyid(c.id)"
                v-if="$can('edit invenstigations')"
              >Edit</a>
            </div>
            <div class="col-6">
              <a
                class="btn waves-effect waves-light btn-danger"
                @click.prevent="deleteInvestigation(c.id,index)"
                href="#"
                v-if="$can('delete invenstigations')"
              >Delete</a>
            </div>
          </div>
          <hr style="width:100%" />
        </div>
      </div>
    </div>
    <!-- <iform
     id="invest-add"
    :invest.sync="invest"
    @submitform="submitform()"
    :errors="ierrors"
/>
 <iform
    id="invest-edit"
    :invest.sync="invest"
    @submitform="updateform()"
    :errors="ierrors"

    />-->
  </div>
</template>
<script>
import iform from "./Form";
import { VBModal } from "bootstrap-vue";
import Swal from "sweetalert2";

export default {
  props: ["url", "name"],
  components: {
    iform
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      investigations: [],
      invest: {
        term: null,
        doctor_id: this.$store.state.user.data.id,
        consultation_id: this.$store.state.consult,
        value: null,
        code: null,
        snomed_ct: null,
        range: null
      },
      ierrors: {}
    };
  },
  methods: {
    bindbyid(id) {
      this.invest = this.investigations.find(c => c.id === id);
    },
    submitform() {
      axios
        .post(`${this.url}s`, this.invest)
        .then(res => {
          this.$toasted.show("Success !");
          this.investigations.unshift(res.data);
        })
        .catch(err => {
          this.ierrors = err.response.data;
        });
    },
    async alert() {
      let { value } = await Swal.fire({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      });
      return value;
    },
    async deleteInvestigation(id, index) {
      if (await this.alert()) {
        axios
          .delete(`${this.url}s/${id}`)
          .then(res => {
            this.$toasted.show("Deleted Successfully !");
            this.investigations = this.investigations.filter(i => i.id !== id);
          })
          .catch(err => {
            this.$toasted.show("Error Deleting Investigation Information", {
              icon: "fa-times-circle",
              type: "error"
            });
          });
      }
    },
    updateform() {
      axios
        .put(`${this.url}s/${this.invest.id}`, this.invest)
        .then(res => {
          this.$toasted.show("Success !");
        })
        .catch(err => {
          this.ierrors = err.response.data;
        });
    }
  },
  mounted() {
    axios(`${this.url}PerConsultation/${this.$store.state.consult}`)
      .then(res => {
        this.investigations = res.data;

        this.$toasted.show("Success");
        console.log(this.investigations);
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>