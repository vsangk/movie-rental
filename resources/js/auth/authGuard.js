import { getInstance } from "./index";

export const authGuard = (to, from, next) => {
    const authService = getInstance();

    const checkAuth = () => {
        // If the user is authenticated, continue with the route
        if (authService.isAuthenticated) {
            return next();
        }

        // Otherwise, log in
        authService.loginWithRedirect({ appState: { targetUrl: to.fullPath } });
    };

    // If loading has already finished, check our auth state using `checkAuth()`
    if (!authService.loading) {
        return checkAuth();
    }

    // Watch for the loading property to change before we check isAuthenticated
    authService.$watch("loading", loading => {
        if (loading === false) {
            return checkAuth();
        }
    });
};
