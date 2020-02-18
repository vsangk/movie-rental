<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="home mb-4">
                    <!-- Check that the SDK client is not currently loading before accessing is methods -->
                    <div v-if="!$auth.loading">
                        <div class="auth-buttons mb-4 d-flex justify-content-end">
                            <!-- show login when not authenticated -->
                            <button v-if="!$auth.isAuthenticated" @click="login">Log in</button>
                            <!-- show logout when authenticated -->
                            <button v-if="$auth.isAuthenticated" @click="logout">Log out</button>
                        </div>

                        <div class="mb-4">
                            <p class="m-0">Test Routes:</p>
                            <router-link v-if="$auth.isAuthenticated" to="/external-api">External Api Test</router-link>
                            <span class="spacer">|</span>
                            <router-link to="/echo-test">Echo Test</router-link>
                        </div>

                        <div class="mb-4">
                            <p class="m-0">Routes:</p>
                            <router-link v-if="$auth.isAuthenticated" to="/profile">Profile</router-link>
                            <span class="spacer">|</span>
                            <router-link to="/film-detail">Film Detail</router-link>
                        </div>
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

<style>
    .router-link-active {
        font-weight: bold;
        text-decoration: underline;
    }
    .spacer {
        margin: 0 10px;
    }
</style>
