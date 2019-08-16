<script>
export default {
    props: ['data', 'index', 'patients'],
    template: `<a href="#" class='fa fa-trash' @click.prevent='erase'></a>`,
    methods: {
        erase() {
       if( window.confirm('Do You really want to delete')){
        const id = this.data.id
        axios.delete(`/users/${id}`)
        .then((res)=>{
        this.$emit('deleteRow',id)
        this.$toasted.show('Deleted Successfully !')
        })
        .catch((err)=>{
          this.$toasted.show('Error Deleting Patient Information',{icon:'fa-times-circle',type:'error'})
      })
      }
        } 
    }
}
</script>