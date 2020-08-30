'use strict';
import Vue from 'vue';
import Layout from './layout';
import store from './store';

let app = new Vue({
    el: '#app',
    store,
    components: {
        'layout': Layout,
    },
    template: `<layout/>`
});