'use strict';

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        data: {
            name: '',
            phone: '',
            message: ''
        }
    },
    getters: {
        getFields(state, getters) {
            return () => state.data
        },
        getField(state, getters) {
            return (name) => {
                return state.data[name];
            }
        } 
    },
    mutations: {
        setField(state, { name: name, value: value }) {
            Vue.set(state.data, name, value);
        },
    },
    actions: {
        setField(context, { name: name, value: value }) {
            context.commit('setField', {
                name: name,
                value: value,
            });
        },
    }
});
