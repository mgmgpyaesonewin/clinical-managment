<template>
  <div class="offset-md-1 col-md-10">
    <div class="card card-content">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">
          <button class="btn btn-info" @click="removeTab">X</button>
          Comment
        </h4>
      </div>
      <div class="row">
        <div class="offset-md-1 col-md-10">
          <div class="form-group justify-content-center">
            <textarea class="form-control" name id="cmt" cols="5" rows="5" v-model="comment" />
            <div class="text-center">
              <button @click.prevent="saveComment" class="btn btn-info">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { bus } from "@/eventbus";
export default {
  props: ["consult", "index"],
  data() {
    return {
      comment: ""
    };
  },
  methods: {
    saveComment() {
      axios
        .post("saveComment", {
          id: this.consult.id,
          comment: this.comment
        })
        .then(res => {
          console.log(res);
        })
        .catch(e => {
          console.log(e);
        });
    },
    update(event) {
      bus.$emit("updateComment", event);
    },
    updateConsult() {
      bus.$emit("updateConsult");
    },
    removeTab() {
      bus.$emit(`${this.index}-remove-tab`, "Comment");
    }
  },
  mounted() {
    // console.log(this.consult)
    // document.getElementById('cmt').focus();
    this.comment = this.consult.comment;
  }
};
</script>