<template>
  <div>
    <ul>
      <li
        v-for="(examination, index) in examinations"
        :key="index"
        @mouseenter="trash = true"
        @mouseleave="trash = false"
      >
        {{ examination.values }}
        <span
          class="link--padding--horizontal span--action--danger"
          v-show="trash"
          @click="deleteExamination(examination.id)"
        >
          <i class="fa fa-trash" style="color: red"></i>
        </span>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: ['examinations'],
  data() {
    return {
      trash: false,
    }
  },
  methods: {
    deleteExamination(id) {
      axios.delete(`examinations/${id}`).then(() => {
        this.$emit('reload-examination')
      })
    },
  },
}
</script>
