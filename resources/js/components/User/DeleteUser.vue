<script>
import Swal from 'sweetalert2'
export default {
    props: ['data', 'index', 'users'],
    template: `<a href="#" class='fa fa-trash' @click.prevent='erase'></a>`,
    methods: {
        async alert() {
            let { value } = await Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });
            return value;
        },
        async erase() {
            if( await this.alert()) {
                const id = this.data.id
                axios.delete(`/users/${id}`)
                .then((res)=>{
                    this.$emit('deleteRow',id)
                    this.$toasted.show('Deleted Successfully !')
                })
                .catch((err)=>{
                    this.$toasted.show('Error Deleting User Information',{icon:'fa-times-circle',type:'error'})
                })
            }
        } 
    }
}
</script>