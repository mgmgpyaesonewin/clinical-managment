<template>
  <multiselect
    v-model="rcode"
    @input="$emit('update-code', rcode)"
    :options="codes"
    :close-on-select="true"
    :show-labels="false"
    placeholder="Type to search problems"
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
    label="title"
    track-by="title"
    @search-change="fetchCode"
  >
    <template slot="option" slot-scope="props">
      <span class="option__title">({{ props.option.code }}) {{ props.option.title }}</span>
    </template>
  </multiselect>
</template>
<style lang="css">
.form-group-override {
  overflow: unset !important;
}
</style>
<script>
import Multiselect from "vue-multiselect";
import { debounce } from "lodash";

export default {
  props: ["code"],
  components: {
    multiselect: Multiselect
  },
  data() {
    return {
      isLoading: false,
      rcode: null,
      codes: []
    };
  },
  methods: {
    limitText(count) {
      return `and ${count} other codes`;
    },
    fetchCode: debounce(function(query) {
      this.isLoading = true;
      axios
        .get("codes", {
          params: {
            key: query
          }
        })
        .then(({ data }) => {
          this.isLoading = false;
          this.codes = data;
        })
        .catch(err => {
          console.log(err);
        });
    }, 1000)
  }
};
</script>