import './bootstrap';
import store from './modules';
import Vue from 'vue';

import GameComponent from './components/Game/GameComponent.vue';

Vue.component('game-component', GameComponent);

new Vue({
  el: '#app',
  store: store,
});
