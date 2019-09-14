<template>
    <div class="card card-shadow border-info">
        <div class="card-header bg-info">
            <label>
                <input type="checkbox" />
                <h5 class="m-b-0 text-white display-inline">{{ title | capitalize }}</h5>
            </label>
        </div>
        <div class="card-body row">
             <div class="col-md-3" v-for="(p, index) in permissionsGroup" :key="index">
                <label><input type="checkbox" value="" v-model="p.selected">{{ p.name }}</label>
            </div>
        </div>
    </div>
</template>
<style lang="css">
    .display-inline {
        display: inline;
    }
    .card-shadow {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    input {
        margin-right: .4rem;
    }
</style>
<script>
export default {
    props: ['permissionsGroup'],
    data() {
        return {
            title: ''
        }
    },
    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    },
    mounted() {
        let names = this.permissionsGroup.map(({ name }) => name.split(' ')[1]);
        this.title = [...new Set(names)];
    },
}
</script>