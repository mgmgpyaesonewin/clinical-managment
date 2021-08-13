<template>
  <multiselect
    :value="patientId"
    @input="$emit('update:patientId', $event)"
    @select="$emit('change-patient', $event)"
    :custom-label="customlabel"
    :options="patients"
    :close-on-select="true"
    :show-labels="false"
    placeholder="Type and Select the Patient"
    open-direction="bottom"
    :searchable="true"
    :loading="isLoading"
    :internal-search="false"
    :clear-on-select="false"
    :options-limit="300"
    :limit="3"
    :limit-text="limitText"
    :max-height="800"
    :show-no-results="false"
    @open="$emit('update:patientId', null)"
    label="title"
    track-by="title"
    @search-change="fetchUsers"
  >
    <!-- <template 
        slot="option" 
        slot-scope="props">
        <span class="option__title">
        ({{ props.option.name }}) {{ props.option.nrc }}
        </span>
    </template>-->
  </multiselect>
</template>
<script>
import Multiselect from "vue-multiselect";

export default {
  props: ["patientId"],
  components: {
    Multiselect
  },
  methods: {
    async fetchUsers(query) {
      this.isLoading = true;
      const { data } = await axios.get("searchpatient", {
        params: {
          key: query
        }
      });
      this.isLoading = false;
      this.patients = data;
    },
    customlabel({ name }) {
      return `${name}`;
    },
    limitText(count) {
      return `and ${count} other codes`;
    }
  },
  data() {
    return {
      patients: [],
      isLoading: false
    };
  }
};
</script>