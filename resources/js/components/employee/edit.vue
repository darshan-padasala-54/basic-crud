<template>
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update Company</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12" v-if="errors">
                                <div v-for="(v, k) in errors" :key="k">
                                    <p v-for="error in v" :key="error" class="alert alert-danger">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" v-model="employee.first_name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" v-model="employee.last_name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-control" v-model="employee.company_id">
                                        <option v-for="company in companies" :value="company.company_id">{{company.company_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" class="form-control number-only" v-model="employee.phone">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="employee.email">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"update-employee",
        data(){
            return {
                employee:{
                    first_name:"",
                    last_name:"",
                    email:"",
                    phone:"",
                    company_id:"",
                    _method:"patch"
                },
                companies:[],
                errors: null,
            }
        },
        mounted(){
            this.showEmployee();
            this.getCompanies();
        },
        methods:{
            async getCompanies(){
                await this.axios.get(`/api/companies`).then(response=>{
                    this.companies = response.data.data
                }).catch(error=>{
                    this.companies = []
                })
            },
            async showEmployee(){
                await this.axios.get(`/api/employee/${this.$route.params.id}/edit`).then(response=>{
                    const { first_name, last_name, company_id, phone, email } = response.data
                    this.employee.first_name = first_name;
                    this.employee.last_name = last_name;
                    this.employee.company_id = company_id;
                    this.employee.phone = phone;
                    this.employee.email = email;
                }).catch(error=>{
                    //console.log(error)
                })
            },
            async update(){
                await this.axios.post(`/api/employee/${this.$route.params.id}`,this.employee).then(response=>{
                    this.$router.push({name:"employeeList"})
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>
