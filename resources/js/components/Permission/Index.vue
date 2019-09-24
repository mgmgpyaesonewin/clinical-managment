<template>
    <div>
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Permissions</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="submit">
                    <h4 class="card-title">{{ $route.query.name | capitalize }}</h4>
                    <div class="div" v-for="(permission,index) in permissions" :key="index">
                        <permission-card v-bind:permissionsGroup.sync="permission"></permission-card>
                    </div>
                    <button type="submit" class="btn btn-primary">Assign Permissions</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style lang="css">
    .card-shadow {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
</style>
<script>
import { BModal, VBModal, BButton } from "bootstrap-vue";
import PermissionCard from './Card';

export default {
    data() {
        return {
            permissions: []
        }
    },
    props: ['id'],
    methods : {
        submit() {
            axios.post('/assignPermissions', {
                roleId: this.id,
                permissionIds : this.permissions.flat()
                    .filter(p => p.selected)                                                                                                                                                                                                                                           
                    .map(p => p.id)
            })
            .then((response) => {
               this.$toasted.show('Success !')
                window.location = "/home/roles"
            })
            .catch ((error) => {
                console.log(error);
            })
        }
    },
    mounted() {
        axios.get(`/permissions/${this.id}`)
        .then((response) => {
            let { attachedPermissions } = response.data;
            let permissionArray = response.data.permissions;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
            permissionArray.map((p) => p.selected = attachedPermissions.includes(p.id));
            this.permissions = permissionArray.map((arr, index) => {
                return index % 4 === 0 ? permissionArray.slice(index, index + 4) : null;
            }).filter(arr => arr);
        })
        .catch((error) => {
            console.log(error);
        })
    },
    components: {
        'permission-card': PermissionCard
    },
    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    }
}
</script>