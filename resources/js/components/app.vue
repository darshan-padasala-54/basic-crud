<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Basic CRUD</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/company" class="nav-item nav-link">Company</router-link>
                        <router-link exact-active-class="active" to="/employee" class="nav-item nav-link">Employee</router-link>
                        <a href="#" @click.prevent="logout" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {
        methods: {
            logout() {
                axios.post('/logout')
                    .catch(error => {
                        window.location.href = '/login';
                    });
            }
        }
    }
</script>
