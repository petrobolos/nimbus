import './bootstrap';
import Vue from 'vue';

import GameComponent from './components/Game/GameComponent.vue';

Vue.component('game-component', GameComponent);

new Vue({
  el: '#app',
});
