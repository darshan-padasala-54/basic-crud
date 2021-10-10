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
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="company.company_name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="company.email">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" v-model="company.website">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <img height="60" width="60" :src="`/storage/${image}`" alt="No Image Found" class="py-2" v-if="image != ''">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" v-on:change="onLogoChange">
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
        name:"update-company",
        data(){
            return {
                company:{
                    company_name:"",
                    email:"",
                    website:"",
                    logo:"",
                    _method:"patch"
                },
                image:"",
                errors: null,
            }
        },
        mounted(){
            this.showCompany()
        },
        methods:{
            onLogoChange(e) {
                this.company.logo = e.target.files[0];
            },
            async showCompany(){
                await this.axios.get(`/api/company/${this.$route.params.id}/edit`).then(response=>{
                    const { company_name, email, website, logo } = response.data
                    this.company.company_name = company_name;
                    this.company.email = email;
                    this.company.website = website;
                    this.image = logo;
                }).catch(error=>{
                    //console.log(error)
                })
            },
            async update(){
                let data = new FormData();
                data.append('company_name', this.company.company_name);
                data.append('email', this.company.email);
                data.append('website', this.company.website != null ? this.company.website : '');
                data.append('logo', this.company.logo);
                data.append('_method', this.company._method);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                await this.axios.post(`/api/company/${this.$route.params.id}`,data,config).then(response=>{
                    this.$router.push({name:"companyList"})
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>
