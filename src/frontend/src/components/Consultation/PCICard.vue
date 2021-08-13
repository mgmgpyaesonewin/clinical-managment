<template>
    <div>
        <div class="card border-dark mb-3">
                            <div class="card-header text-info">
                                <div class="row">
                                    <span class="col-9">{{header}}</span><a @click.prevent="$emit('open')" class="col-3" href="#" v-if="$can('create consultations')">Add</a>
                                </div>
                                </div>
                            <div class="card-body ">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['header',]
}
</script>