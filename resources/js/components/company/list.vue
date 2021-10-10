<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"companyCreate"}' class="btn btn-primary float-right">Create New Company</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Company List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="companies.data && companies.data.length > 0">
                            <tr v-for="(company,key) in companies.data" :key="key">
                                <td>{{ company.company_name }}</td>
                                <td>{{ company.email }}</td>
                                <td>{{ company.website }}</td>
                                <td v-if="company.logo != '' && company.logo != null"><img height="40" width="40" :src="`/storage/${company.logo}`" alt="No Image Found"></td>
                                <td v-else>-</td>
                                <td>
                                    <router-link :to='{name:"companyEdit",params:{id:company.company_id}}' class="btn btn-success">Edit</router-link>
                                    <button type="button" @click="deleteCompany(company.company_id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="6" align="center">No Company Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination align="center" :data="companies" @pagination-change-page="getCompanies"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import pagination from 'laravel-vue-pagination'
    export default {
        name: "companies",
        components:{
            pagination
        },
        data(){
            return {
                companies:{
                    type:Object,
                    default:null
                }
            }
        },
        mounted(){
            this.getCompanies()
        },
        methods:{
            async getCompanies(page=1){
                await this.axios.get(`/api/company?page=${page}`).then(response=>{
                    this.companies = response.data
                }).catch(error=>{
                    this.companies = []
                })
            },
            deleteCompany(id){
                if(confirm("Are you sure to delete this company?")){
                    this.axios.delete(`/api/company/${id}`).then(response=>{
                        this.getCompanies()
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
