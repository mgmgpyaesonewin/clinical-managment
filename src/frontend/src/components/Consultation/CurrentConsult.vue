<template>
  <div>
    <div class="card mt-1">
      <div class="card-body" style="font-size:13px;padding:0">
        <div class="container-fluid">
          <div class="row">
            <div class="col-2">
              <h5 class="card-title">Date</h5>
            </div>
            <div class="col-8">
              <h5 class="card-title">Details</h5>
            </div>
            <div class="col-1">
              <h5 class="card-title">Doctor</h5>
            </div>
            <div class="col-1">
              <a v-b-modal.consult class="btn waves-effect waves-light btn-info" href="#">Edit</a>
            </div>
          </div>
          <div class="row">
            <div class="col-2" style="font-size:12px;">{{formattedDate(consultation.created_at)}}</div>
            <div class="col-8">Title : {{consultation.title}}</div>
            <div class="col-2">{{consultation.doctor.name}}</div>
          </div>
        </div>
      </div>
      <hr />
      <ProblemTab :selected-problems="isEditMode(consultation) ? problems : []"></ProblemTab>
      <hr style="width:100%" />
    </div>
  </div>
</template>
<style lang="css">
.sticky-offset {
  top: 100px;
}
</style>
<script>
import { VBModal } from "bootstrap-vue";
import { bus } from "../../eventbus";
import ProblemTab from "./ProblemTab";
export default {
  components: {
    ProblemTab
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      consultation: {},
      codes: []
    };
  },
  computed: {
    problems() {
      return this.$isNotNull(this.consultation)
        ? this.consultation.problems
        : [];
    }
  },
  methods: {
    isEditMode(value) {
      return !this.$isNotNull(value);
    },
    InvestOpen() {
      console.log(this.$refs.invest);
      this.$refs.invest.$children[0].show();
    },
    formattedDate(date) {
      return moment(date).format("MMMM Do YYYY, h:mm a");
    },
    updateConsult() {
      axios
        .put(`consultations/${this.$store.state.consult}`, this.consultation)
        .then(res => {
          this.$toasted.show("Success !");
          this.consultation = res.data;
        })
        .catch(err => {
          this.errors = err.response.data;
          console.log(err.response.data);
        });
    },
    fetchData() {
      axios
        .get("codes/")
        .then(({ data }) => {
          this.codes = data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  mounted() {
    axios
      .get(
        `consultations/${this.$store.state.consult}?id=${this.$store.state.patient.id}`
      )
      .then(res => {
        this.consultation = res.data;
      })
      .catch(err => console.log(err));
  }
};
</script>