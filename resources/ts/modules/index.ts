import Vue from 'vue';
import Vuex from 'vuex';
import GameModule from './game.module';

Vue.use(Vuex);
Vue.config.devtools = true;

const store = new Vuex.Store({
  modules: {
    GameModule,
  },
});

export default store;
