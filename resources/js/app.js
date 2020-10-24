require("./bootstrap");
window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("user-page", require("./components/User.vue").default);
Vue.component("update-form", require("./components/Update.vue").default);
Vue.component("register-form", require("./components/Register.vue").default);
Vue.component(
    "password-reset",
    require("./components/PasswordReset.vue").default
);
Vue.component("login-form", require("./components/Login.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
