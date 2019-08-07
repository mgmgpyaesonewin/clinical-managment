<script>
export default {
    props: ['data', 'index', 'patientdata'],
    template: `<a href="#" class='fa fa-trash' @click.prevent='erase'></a>`,
    methods: {
        erase() {
       if( window.confirm('Do You really want to delete')){
        const id = this.data.id
        axios.delete(`/patients/${id}`)
        .then((res)=>{
         console.log(res)
        this.patientdata.splice(this.index-1,1);
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