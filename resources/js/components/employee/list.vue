<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"employeeCreate"}' class="btn btn-primary float-right">Create New Employee</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody v-if="employees.data && employees.data.length > 0">
                            <tr v-for="(employee,key) in employees.data" :key="key">
                                <td>{{ employee.first_name+ ' '+employee.last_name }}</td>
                                <td>{{ employee.company.company_name }}</td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ employee.email }}</td>
                                <td>
                                    <router-link :to='{name:"employeeEdit",params:{id:employee.employee_id}}' class="btn btn-success">Edit</router-link>
                                    <button type="button" @click="deleteEmployee(employee.employee_id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="6" align="center">No Employee Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination align="center" :data="employees" @pagination-change-page="getEmployees"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import pagination from 'laravel-vue-pagination'
    export default {
        name: "employees",
        components:{
            pagination
        },
        data(){
            return {
                employees:{
                    type:Object,
                    default:null
                }
            }
        },
        mounted(){
            this.getEmployees()
        },
        methods:{
            async getEmployees(page=1){
                await this.axios.get(`/api/employee?page=${page}`).then(response=>{
                    this.employees = response.data
                }).catch(error=>{
                    this.employees = []
                })
            },
            deleteEmployee(id){
                if(confirm("Are you sure to delete this Employee?")){
                    this.axios.delete(`/api/employee/${id}`).then(response=>{
                        this.getEmployees()
                    }).catch(error=>{
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
