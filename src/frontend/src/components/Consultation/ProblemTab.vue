<template>
  <b-tabs content-class="mt-3">
    <b-tab v-for="(p, i) in problems" :key="p.id">
      <template v-slot:title>
        {{ p.code.slice(0, 11) }}...
        <button class="btn btn-outline-dark" @click="closeTab(i)">x</button>
      </template>
      <pcitabs :index="i" :consult="consultation" class="customvtab" />
    </b-tab>
    <template v-slot:tabs-end>
      <b-nav-item @click.prevent="newTab" href="#">
        <b>
          <button class="btn btn-outline-primary">+</button>
        </b>
      </b-nav-item>
    </template>
  </b-tabs>
</template>

<script>
import { BTabs, BTab, BNavItem } from "bootstrap-vue";
import pcitabs from "./PCITabs";
import { bus } from "../../eventbus";

export default {
  components: {
    pcitabs,
    BTabs,
    BTab,
    BNavItem
  },
  data() {
    return {
      problems: []
    };
  },
  methods: {
    newTab() {
      this.problems.push({ id: null, code: "New Problem" });
      bus.$emit("NEW_TAB");
    },
    closeTab(index) {
      this.problems.splice(index, 1);
    }
  },
  mounted() {
    bus.$on("SET_PROBLEM", ({ problem, index }) => {
      this.problems[index] = problem;
    });

    bus.$on("DELETE_PROBLEM", index => {
      this.closeTab(index);
    });

    axios
      .get(
        `consultations/${this.$store.state.consult}?id=${this.$store.state.patient.id}`
      )
      .then(({ data }) => {
        this.problems = data.problems;
        this.consultation = data;
        this.newTab();
      })
      .catch(err => console.log(err));
  },
  destroyed() {
    bus.$off("SET_PROBLEM");
    bus.$off("DELETE_PROBLEM");
  }
};
</script>

<style>
</style>