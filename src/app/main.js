'use strict';
import Vue from 'vue';
import Layout from './layout';

let app = new Vue({
    el: '#app',
    components: {
        'layout': Layout,
    },
    template: `<layout/>`
});