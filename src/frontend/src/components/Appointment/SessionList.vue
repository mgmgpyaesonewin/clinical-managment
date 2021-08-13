<template>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Time</th>
        <th>Patient Name</th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(slot, index) in data"
        :key="index"
        :class="listGroupItemCSSClass(isAvailable(slot.booked))"
      >
        <th>{{ slot.time }}</th>
        <td @click="editLabel(slot)">
          <multiselect
            v-if="slot.isEditing"
            v-model="slot.value"
            :options="patients"
            @close="bookAppointment(index)"
            track-by="name"
            label="name"
          />
          <span v-else>{{ slot.value.name || getAvailableBooking(isAvailable(slot.booked)) }}</span>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
  name: "SessionList",
  components: {
    multiselect: Multiselect
  },
  props: ["slots", "patients", "session_id"],
  data() {
    return {
      data: []
    };
  },
  methods: {
    isAvailable: function(status) {
      return parseInt(status) === 0;
    },
    getAvailableBooking: function(result) {
      return result ? "Available" : "Already Boooked";
    },
    listGroupItemCSSClass: function(result) {
      return result ? "table-success" : "table-warning";
    },
    editLabel(slot) {
      slot.isEditing = true;
    },
    bookAppointment(index) {
      this.data[index].isEditing = false;
      this.$emit("book-appointment", {
        patient: this.data[index].value,
        session_id: this.session_id,
        session_interval: this.data[index].id
      });
    }
  },
  directives: {
    focus: {
      inserted(el) {
        el.focus();
      }
    }
  },
  mounted() {
    this.data = this.slots.map(slot =>
      Object.assign(
        {},
        {
          isEditing: false,
          value: ""
        },
        slot
      )
    );
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
</style>