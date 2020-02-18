<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="home mb-4">
                    <!-- Check that the SDK client is not currently loading before accessing is methods -->
                    <div v-if="!$auth.loading">
                        <div class="auth-buttons mb-2">
                            <!-- show login when not authenticated -->
                            <button v-if="!$auth.isAuthenticated" @click="login">Log in</button>
                            <!-- show logout when authenticated -->
                            <button v-if="$auth.isAuthenticated" @click="logout">Log out</button>
                        </div>

                        <router-link v-if="$auth.isAuthenticated" to="/profile">Profile</router-link>
                        <router-link v-if="$auth.isAuthenticated" to="/external-api">External Api Test</router-link>
                        <router-link to="/film-detail">Film Detail</router-link>
                    </div>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            // Log the user in
            login() {
                this.$auth.loginWithRedirect();
            },
            // Log the user out
            logout() {
                this.$auth.logout({
                    returnTo: window.location.origin
                });
            }
        }
    }
</script>
