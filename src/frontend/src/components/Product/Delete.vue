<script>
import Swal from "sweetalert2";
export default {
  props: ["data", "index", "products"],
  template: `<a href="#" class='fa fa-trash' @click.prevent='pdelete()'></a>`,
  methods: {
    async alert() {
      let { value } = await Swal.fire({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      });
      return value;
    },
    async pdelete() {
      if (await this.alert()) {
        const id = this.data.product_id;
        console.log(this.data);
        axios
          .delete(`/products/${id}`)
          .then(() => {
            this.$emit("deleteRow", id);
            this.$toasted.show("Deleted Successfully !");
          })
          .catch(() => {
            this.$toasted.show("Error Deleting Patient Information", {
              icon: "fa-times-circle",
              type: "error"
            });
          });
      }
    }
  }
};
</script>