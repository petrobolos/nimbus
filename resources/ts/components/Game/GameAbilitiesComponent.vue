<template>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-around">
        <section>
            <h5>Abilities:</h5>
            <ol class="list-group list-group-numbered">
                <game-ability-component v-for="n in 5"></game-ability-component>
            </ol>
        </section>
        <section>
            <h5>Switch:</h5>
            <ol class="list-group list-group-numbered">
                <game-ability-component v-for="n in 5"></game-ability-component>
            </ol>
        </section>
    </div>
</template>

<script lang="ts">
import GameAbilityComponent from './GameAbilityComponent.vue';
import Component from "vue-class-component";
import Vue from 'vue';

@Component({
    components: {GameAbilityComponent}
})
export default class GameAbilitiesComponent extends Vue {
    //
}
</script>
