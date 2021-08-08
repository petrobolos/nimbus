import './bootstrap';
import Vue from 'vue';

import GameAbilitiesComponent from "./components/Game/GameAbilitiesComponent.vue";
import GameChatComponent from "./components/Game/GameChatComponent.vue";
import GameComponent from "./components/Game/GameComponent.vue";
import GameStatsComponent from "./components/Game/GameStatsComponent.vue";

Vue.component('game-abilities-component', GameAbilitiesComponent);
Vue.component('game-chat-component', GameChatComponent);
Vue.component('game-component', GameComponent);
Vue.component('game-stats-component', GameStatsComponent);

new Vue({
    el: '#app'
});
