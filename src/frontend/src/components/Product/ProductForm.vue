<template>
  <b-modal hide-footer :id="this.modal" title="Product's Information">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <form class="form-material form-horizontal">
            <div class="form-group">
              <label class="col-md-12" for="example-email">Name</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="product.name"
                  :class="{'is-invalid':  errors.name ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Name"
                />
                <div class="invalid-feedback">{{errors.name && errors.name[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Quantity</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="product.quantity"
                  :class="{'is-invalid':  errors.quantity ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Quantity"
                />
                <div class="invalid-feedback">{{errors.quantity && errors.quantity[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Price</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="product.price"
                  :class="{'is-invalid':  errors.price ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Price"
                />
                <div class="invalid-feedback">{{errors.price && errors.price[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Minimun Order</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="product.min_order"
                  :class="{'is-invalid':  errors.min_order ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Minimun Order"
                />
                <div class="invalid-feedback">{{errors.min_order && errors.min_order[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Maximum Order</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="product.max_order"
                  :class="{'is-invalid':  errors.max_order ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Maximum Order"
                />
                <div class="invalid-feedback">{{errors.max_order && errors.max_order[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Description</label>
              <div class="col-md-12">
                <textarea
                  :class="{'is-invalid':  errors.description ? true : false}"
                  class="form-control"
                  placeholder="Enter Product Description"
                  id
                  v-model="product.description"
                  cols="20"
                  rows="5"
                ></textarea>
                <div class="invalid-feedback">{{errors.description && errors.description[0]}}</div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button
                @click.prevent="formsubmit()"
                type="submit"
                class="btn btn-info waves-effect waves-light m-r-10"
              >Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </b-modal>
</template>
<style lang="css"></style>
<script>
import { BModal } from "bootstrap-vue";
export default {
  components: {
    'b-modal': BModal,
  },
  props: ["product", "errors", "modal"],
  data() {
    return {};
  },
  methods: {
    formsubmit() {
      this.$emit("formsubmit");
    }
  },
  mounted() {
    this.$root.$on("bv::modal::show", (bvEvent, modalId) => {
      if (modalId === "create") {
        this.$emit("resetProduct");
      }
    });
  }
};
</script>
