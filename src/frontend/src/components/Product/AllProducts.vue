<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Information Of All Products</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
          <button type="button" v-b-modal.create class="btn btn-info d-lg-block m-l-15">
            <i class="fa fa-plus-circle"></i> New Product
          </button>
        </div>
      </div>
      <div class="row">
        <product-form
          :errors.sync="errors"
          :product.sync="product"
          modal="create"
          @resetProduct="resetProduct()"
          @formsubmit="saveProduct()"
        />
        <product-form
          :errors.sync="errors"
          :product.sync="product"
          modal="edit"
          @formsubmit="saveEditedUser()"
        />
      </div>
    </div>
    <div class="col-12">
      <v-client-table
        :columns="columns"
        :data="products"
        :options="options"
      >
        <div slot="action" slot-scope="props">
          <a
            href="#"
            @click.prevent="bindData(props.row.id)"
            v-b-modal.edit
            class="fa fa-edit"
            v-if="$can('edit users')"
          ></a>
          <delete-product
            @deleteRow="deleteRow($event)"
            :products.sync="products"
            :index="props.index"
            :data="props.row"
          ></delete-product>
        </div>
        <!-- <template slot="child_row" slot-scope="props">
          <div>
            <b>Address :</b>
            {{props.row.address}}
          </div>
          <div>
            <b>Gender :</b>
            {{props.row.gender}}
          </div>
          <div>
            <b>City :</b>
            {{props.row.city}}
          </div>
        </template> -->
      </v-client-table>
    </div>
  </div>
</template>

<style lang="css">
.table td,
.table th {
  padding: 0.5rem;
}

.table {
  border: 0px;
  padding: 0;
  border-spacing: 0;
  margin: 0;
  border-collapse: collapse;
}

.VuePagination {
  justify-content: center;
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: left;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

.modal-backdrop {
  background-color: #00000085 !important;
}
</style>

<script>
import { VBModal } from "bootstrap-vue";
import ProductForm from "./ProductForm";
import DeleteProduct from "./Delete";

let ProductModel = () => {
  return {
    name: null,
    quantity: null,
    price: null,
    min_order: null,
    max_order: null,
    description: null
  };
};

export default {
  components: {
    "product-form": ProductForm,
    "delete-product": DeleteProduct
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      modal: "create",
      product: {
        name: null,
        quantity: null,
        price: null,
        min_order: null,
        max_order: null,
        description: null
      },
      errors: {},
      columns: [
        "product_id",
        "name",
        "quantity",
        "price",
        "min_order",
        "max_order",
        "description",
        "action"
      ],
      products: [],
      options: {
        perPage: 5,
        sortIcon: {
          base: "fa",
          is: "fa-sort",
          up: "fa-sort-up",
          down: "fa-sort-down"
        },
        templates: {
          erase: "delete"
        },
        sortable: ["product_id"],
        filterable: [
          "product_id",
          "name",
          "quantity",
          "price",
          "min_order",
          "max_order",
          "description"
        ]
      }
    };
  },
  methods: {
    deleteRow(id) {
      this.products = this.products.filter(p => p.product_id !== id);
    },
    bindData(id) {
      this.product = this.products.find(p => p.id === id);
    },
    resetProduct() {
      this.product = ProductModel();
    },
    saveProduct() {
      axios
        .post(`products?hospital_id=${this.$store.state.user.data.hospital_id}`, this.product)
        .then(() => {
          this.$toasted.show("Success !");
          // this.$router.push("/products");
          this.fetchData();
          this.resetProduct();
        })
        .catch(error => {
          this.errors = error.response.data;
        });
    },
    saveEditedUser() {
      axios
        .put(`products/${this.product.product_id}`, this.product)
        .then(response => {
          this.$toasted.show("Success !");
          // this.$router.push("/patients");
          console.log(response.data);
           this.resetProduct();
        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
        });
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
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>