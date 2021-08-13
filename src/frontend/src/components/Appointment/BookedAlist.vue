<template>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
            <th>Time</th>
            <th>Patient Name</th>
            <th> Duration</th>
            <th>Session Comment</th>
            <th>Action</th>
            </tr>
            </thead>
          <tbody>
               <tr :key="a.id" v-for="a in appo">
                <td>{{a.session_interval.time}}</td>
                <td>{{a.patient.name}}</td>
                <td>{{a.session.interval}}</td>
                <td>{{a.session.cmt}}</td>
                <td>       
                    <a href="#">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>                                  
                </td>
            </tr>
          </tbody>
           
        </table>
    </div>
</template>
<script>
export default {
    props:['appo']

}
</script>