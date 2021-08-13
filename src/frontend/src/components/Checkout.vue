<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Checkout</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-body printableArea" id="printableArea">
          <h3>
            <b>INVOICE</b>
            <span class="pull-right">#5669626</span>
          </h3>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="pull-left">
                <address>
                  <h3>
                    <b class="text-danger">Hospital Name</b>
                  </h3>
                  <p class="text-muted m-l-5">
                    E 104, Dharti-2,
                    <br />Nr' Viswakarma Temple,
                    <br />Talaja Road,
                    <br />Bhavnagar - 364002
                  </p>
                </address>
              </div>
              <div class="pull-right text-right">
                <address>
                  <h3>To,</h3>
                  <h4 class="font-bold">Patient Name,</h4>
                  <p class="text-muted m-l-30">
                    E 104, Dharti-2,
                    <br />Nr' Viswakarma Temple,
                    <br />Talaja Road,
                    <br />Bhavnagar - 364002
                  </p>
                  <p class="m-t-30">
                    <b>Invoice Date :</b>
                    <i class="fa fa-calendar"></i> 23rd Jan 2017
                  </p>
                  <p>
                    <b>Due Date :</b>
                    <i class="fa fa-calendar"></i> 25th Jan 2017
                  </p>
                </address>
              </div>
            </div>
            <div class="col-md-6 offset-md-3">
              <label class="typo__label">Select Products with search</label>
              <multiselect
                v-model="value"
                :options="products"
                :custom-label="nameWithLang"
                placeholder="Select one"
                label="name"
                track-by="name"
              ></multiselect>
            </div>
            <div class="col-md-6 offset-md-3">
              <label class="typo__label">Select Products with search</label>
              <multiselect
                v-model="valueCode"
                :options="codes"
                :custom-label="nameWithLangCode"
                placeholder="Select one"
                label="name"
                track-by="name"
                @close="pushValue"
              ></multiselect>
            </div>
            <div class="col-md-12">
              <div class="table-responsive m-t-40" style="clear: both;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th class="text-right">Quantity</th>
                      <th class="text-right">Unit Cost</th>
                      <th class="text-right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                      <td class="text-center">{{ product.product_id }}</td>
                      <td>{{ product.name }}</td>
                      <td>{{ product.description }}</td>
                      <td class="text-right">{{ product.min_order }}</td>
                      <td class="text-right">{{ product.price }}</td>
                      <td class="text-right">{{ product.min_order * product.price }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-12">
              <div class="pull-right m-t-30 text-right">
                <p>Sub - Total amount: $13,848</p>
                <p>vat (10%) : $138</p>
                <hr />
                <h3>
                  <b>Total :</b> $13,986
                </h3>
              </div>
              <div class="clearfix"></div>
              <hr />
              <div class="text-right">
                <button class="btn btn-primary" type="button" @click="print()">
                  <span>
                    <i class="fa fa-print"></i> Print
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect
  },
  data() {
    return {
      value: { name: "Name", price: "Price" },
      selected: [],
      products: [],
      valueCode: { code: "Code", title: "Term" },
      selectedCode: [],
      codes: []
    };
  },
  methods: {
    nameWithLang({ name, price }) {
      return `${name} — [${price}]`;
    },
    nameWithLangCode({ code, title }) {
      return `${code} — [${title}]`;
    },
    fetchData() {
      axios
        .get("products/")
        .then(({ data: { data } = [] }) => {
          this.products = data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    fetchCode() {
      axios
        .get("codes/")
        .then(({ data }) => {
          this.codes = data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    pushValue() {
      this.selected.push(this.value);
    },
    print() {
      window.print();
    }
  },
  mounted() {
    this.fetchData();
    this.fetchCode();
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
</style>