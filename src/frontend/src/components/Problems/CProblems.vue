<template>
  <div class="offset-md-1 col-md-10">
    <div class="card card-content">
      <div class="card-header bg-info">
        <div class="row">
          <h4 class="m-b-0 text-white my-auto">Problem</h4>
          <button
            class="btn btn-info"
            @click="() => ( this.$bvModal.show(`modal-problem-${index}`) )"
            v-show="problem && problem.code === null"
          >
            <i class="fas fa-plus"></i>
          </button>
          <Form
            :problem="problem"
            :id="`modal-problem-${index}`"
            :errors="errors"
            @save-problem="saveProblem"
          />
          <button class="btn btn-info" @click="removeTab">
            <i class="fas fa-minus"></i>
          </button>
          <button
            class="btn btn-info"
            v-show="problem && problem.id != null"
            @click="deleteProblem"
          >
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="col-md-10 offset-md-1">
          <div class="d-flex align-content-center">
            <pulse-loader :loading="loading" color="#03a9f3"></pulse-loader>
          </div>
          <dl class="row" v-show="!loading">
            <dt class="col-sm-3">Problem</dt>
            <dd class="col-sm-9">{{ problem && problem.code }}</dd>
            <dt class="col-sm-3">Type</dt>
            <dd class="col-sm-9">{{ problem && problem.type }}</dd>
            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">{{ problem && problem.status }}</dd>
            <dt class="col-sm-3">Action</dt>
            <dd class="col-sm-9">{{ problem && problem.action }}</dd>
            <dt class="col-sm-3">Duration</dt>
            <dd class="col-sm-9">{{ problem && problem.duration }}</dd>
            <dt class="col-sm-3">Start Time</dt>
            <dd class="col-sm-9">{{ problem && problem.start_time }}</dd>
            <dt class="col-sm-3">End Time</dt>
            <dd class="col-sm-9">{{ problem && problem.end_time }}</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import API from "@/api.js";
import Swal from "sweetalert2";
import { bus } from "../../eventbus";
import Form from "./Form";

export default {
  props: ["index", "id"],
  components: {
    Form
  },
  data() {
    return {
      loading: true,
      problem: {
        id: null,
        patient_id: this.$route.params.id,
        name: "asdf",
        type: "",
        start_time: null,
        end_time: null,
        status: "",
        duration: null,
        doctor_id: this.$store.state.user.data.id,
        consultation_id: this.$store.state.consult,
        code: null,
        action: ""
      },
      errors: {}
    };
  },
  methods: {
    removeTab() {
      bus.$emit(`${this.index}-remove-tab`, "Problem");
    },
    saveProblem() {
      this.problem.code = `(${this.problem.code.code}) ${this.problem.code.title}`;
      this.loading = true;
      axios
        .post(API.saveProblem, this.problem)
        .then(({ data }) => {
          this.$toasted.show("Success !");
          this.$bvModal.hide(`modal-problem-${this.index}`);
          this.loading = false;
          this.problem = { ...this.problem, ...data };
          bus.$emit("SET_PROBLEM", {
            problem: this.problem,
            index: this.index
          });
        })
        .catch(err => {
          this.ierrors = err.response.data.errors;
          console.log(this.ierrors);
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
    updateform() {
      axios
        .put(`${this.url}s/${this.problem.id}`, this.problem)
        .then(res => {
          this.$toasted.show("Success !");
        })
        .catch(err => {
          this.ierrors = err.response.data;
          console.log(this.ierrors);
        });
    },
    getProblemByID() {
      axios
        .get(`problem/${this.id}`)
        .then(({ data }) => {
          this.loading = false;
          this.problem = { ...this.problem, ...data };
        })
        .catch(err => console.log(err));
    },
    deleteProblem() {
      axios
        .delete(`problems/${this.problem.id}`)
        .then(() => {
          bus.$emit("DELETE_PROBLEM", this.index);
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  mounted() {
    if (this.$isNotNull(this.id)) {
      this.getProblemByID();
    } else {
      this.loading = false;
    }
  },
  created() {
    bus.$on("saveProblem", this.saveProblem);
    bus.$on("NEW_TAB", () => {
      console.log("new tab");
      this.problem = {
        patient_id: this.$route.params.id,
        name: "asdf",
        type: "",
        start_time: null,
        end_time: null,
        status: "",
        duration: null,
        doctor_id: this.$store.state.user.data.id,
        consultation_id: this.$store.state.consult,
        code: null,
        action: ""
      };
    });
  },
  destroyed() {
    bus.$off("NEW_TAB");
  }
};
</script>

<style scoped>
.padding {
  padding-top: 20px;
}
</style>