<template>
    <div>
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Permissions</h4>
            </div>
        </div>
        <h4>{{ name | capitalize }}</h4>
        <div class="div" v-for="(permission,index) in permissions" :key="index">
            <permission-card v-bind:permissionsGroup.sync="permission"></permission-card>
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
    props: ['name'],
    mounted() {
        axios.get('/permissions')
        .then((response) => {
            let permissionArray = response.data;
            permissionArray.map((p) => p.selected = false);
            this.permissions = permissionArray.map((arr, index) => {
                return index % 4 === 0 ? permissionArray.slice(index, index + 4) : null;
            }).filter(arr => arr);
            console.log(this.permissions);
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